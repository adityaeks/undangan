<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class DownloadThemeAssetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:download-assets {theme=3d-motion-05}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download remote assets from the.invisimple.id to public/themes/{theme} and update template';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $theme = $this->argument('theme');
        $viewPath = resource_path("views/demo/{$theme}.blade.php");

        if (! File::exists($viewPath)) {
            $this->error("View not found: {$viewPath}");

            return self::FAILURE;
        }

        $this->info("Scanning assets in {$viewPath}...");
        $content = File::get($viewPath);

        // Match all http/https *.invisimple.id URLs (both unescaped and json-escaped)
        preg_match_all('/https?:[\\\\\/]+(?:the|namabrand|[a-z0-9\.\-]+)\.invisimple\.id[^"\'\s<>)\\\\,]+/i', $content, $matches);

        $baseDir = public_path("themes/{$theme}");
        File::ensureDirectoryExists($baseDir);

        $this->downloadElementorChunks($theme, $baseDir);
        $this->downloadUseAnyFonts($theme, $baseDir);
        $this->downloadFontAwesomeWebfonts($theme, $baseDir);
        $this->downloadElementorLibs($theme, $baseDir);
        $this->downloadVideos($theme, $baseDir);

        $rawUrls = array_unique($matches[0]);
        if (empty($rawUrls)) {
            $this->info("Assets in {$viewPath} are already using local paths.");

            return self::SUCCESS;
        }

        $this->info('Found '.count($rawUrls).' remote asset references.');

        $replacements = [];
        $downloadedCount = 0;
        $failedCount = 0;

        foreach ($rawUrls as $rawUrl) {
            // Clean escaped slashes
            $normalUrl = str_replace('\\/', '/', $rawUrl);

            // Strip query string for local file path
            $parsed = parse_url($normalUrl);
            $urlPath = ltrim($parsed['path'] ?? '', '/');

            if (empty($urlPath)) {
                continue;
            }

            // Simplify path under theme: wp-content/uploads -> uploads, wp-content/plugins -> plugins, etc.
            $relativePath = preg_replace('#^wp-content/#i', '', $urlPath);
            $localFilePath = $baseDir.'/'.$relativePath;
            $localDir = dirname($localFilePath);

            File::ensureDirectoryExists($localDir);

            // Download file if not yet existing or empty
            if (! File::exists($localFilePath) || filesize($localFilePath) === 0) {
                // Check if file exists in another theme folder first (e.g. 3d-motion-05)
                $siblingThemes = ['3d-motion-05', '3d-motion-01'];
                $copied = false;
                foreach ($siblingThemes as $srcTheme) {
                    if ($srcTheme === $theme) {
                        continue;
                    }
                    $siblingPath = public_path("themes/{$srcTheme}/{$relativePath}");
                    if (File::exists($siblingPath) && filesize($siblingPath) > 0) {
                        File::copy($siblingPath, $localFilePath);
                        $copied = true;
                        $downloadedCount++;
                        $this->line("<info>[COPIED from {$srcTheme}]</info> {$relativePath}");
                        break;
                    }
                }

                if (! $copied) {
                    try {
                        $response = Http::withHeaders([
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                            'Referer' => 'https://the.invisimple.id/',
                        ])->timeout(15)->get($normalUrl);

                        if ($response->successful() && strlen($response->body()) > 0) {
                            File::put($localFilePath, $response->body());
                            $downloadedCount++;
                            $this->line("<info>[OK]</info> {$normalUrl} -> {$relativePath}");
                        } else {
                            $failedCount++;
                            $this->warn("[FAIL {$response->status()}] {$normalUrl}");
                        }
                    } catch (\Throwable $e) {
                        $failedCount++;
                        $this->error("[ERR] {$normalUrl}: ".$e->getMessage());
                    }
                }
            } else {
                $this->line("<comment>[EXISTS]</comment> {$relativePath}");
            }

            // Prepare replacement
            $localWebUrl = "/themes/{$theme}/".str_replace('\\', '/', $relativePath);
            $replacements[$rawUrl] = $localWebUrl;

            // Also check if the rawUrl had json-escaped form
            $escapedRawUrl = str_replace('/', '\\/', $normalUrl);
            $escapedLocalUrl = str_replace('/', '\\/', $localWebUrl);
            $replacements[$escapedRawUrl] = $escapedLocalUrl;
        }

        // Apply replacements to the blade file
        $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);

        // Also check any leftover invisimple.id domains
        $newContent = preg_replace(
            '#https?:[\\\\\/]+(?:the|namabrand|[a-z0-9\.\-]+)\.invisimple\.id[\\\\\/]+wp-content[\\\\\/]+#i',
            "/themes/{$theme}/",
            $newContent
        );

        File::put($viewPath, $newContent);

        $this->info("Downloaded: {$downloadedCount}, Failed: {$failedCount}, Total: ".count($rawUrls));
        $this->info("Updated {$viewPath} successfully with local assets!");

        return self::SUCCESS;
    }

    /**
     * Download dynamic webpack runtime bundle chunks for Elementor and Elementor Pro.
     */
    protected function downloadElementorChunks(string $theme, string $baseDir): void
    {
        $runtimes = [
            'elementor' => [
                'file' => $baseDir.'/plugins/elementor/assets/js/webpack.runtime.js',
                'url_prefix' => 'https://the.invisimple.id/wp-content/plugins/elementor/assets/js/',
                'local_dir' => $baseDir.'/plugins/elementor/assets/js',
            ],
            'elementor-pro' => [
                'file' => $baseDir.'/plugins/elementor-pro/assets/js/webpack-pro.runtime.js',
                'url_prefix' => 'https://the.invisimple.id/wp-content/plugins/elementor-pro/assets/js/',
                'local_dir' => $baseDir.'/plugins/elementor-pro/assets/js',
            ],
        ];

        foreach ($runtimes as $plugin => $cfg) {
            if (! File::exists($cfg['file'])) {
                continue;
            }

            $content = File::get($cfg['file']);
            preg_match_all('/if\s*\(\s*chunkId\s*===\s*"([^"]+)"\s*\)\s*return\s*(""\s*\+\s*chunkId\s*\+\s*)?"([^"]+)";/', $content, $matches, PREG_SET_ORDER);

            $bundles = [];
            foreach ($matches as $m) {
                $chunkId = $m[1];
                $hasPrefix = ! empty($m[2]);
                $suffix = $m[3];
                $bundleName = $hasPrefix ? ($chunkId.$suffix) : $suffix;
                if (str_ends_with($bundleName, '.bundle.js')) {
                    $bundles[] = $bundleName;
                }
            }
            $bundles = array_unique($bundles);

            $this->info("Downloading dynamic {$plugin} chunks (".count($bundles).' found)...');

            foreach ($bundles as $bundle) {
                $targetFile = $cfg['local_dir'].'/'.$bundle;
                if (File::exists($targetFile) && filesize($targetFile) > 0) {
                    continue;
                }

                // Try copying from sibling theme first
                $siblingThemes = ['3d-motion-05', '3d-motion-01'];
                $copied = false;
                foreach ($siblingThemes as $srcTheme) {
                    if ($srcTheme === $theme) {
                        continue;
                    }
                    $siblingPath = public_path("themes/{$srcTheme}/plugins/{$plugin}/assets/js/{$bundle}");
                    if (File::exists($siblingPath) && filesize($siblingPath) > 0) {
                        File::copy($siblingPath, $targetFile);
                        $copied = true;
                        $this->line("<info>[CHUNK COPIED]</info> {$bundle}");
                        break;
                    }
                }

                if (! $copied) {
                    try {
                        $remoteUrl = $cfg['url_prefix'].$bundle;
                        $res = Http::withHeaders([
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                            'Referer' => 'https://the.invisimple.id/',
                        ])->timeout(15)->get($remoteUrl);

                        if ($res->successful() && strlen($res->body()) > 0 && ! str_starts_with($res->body(), '<!DOCTYPE')) {
                            File::put($targetFile, $res->body());
                            $this->line("<info>[CHUNK OK]</info> {$bundle}");
                        }
                    } catch (\Throwable $e) {
                        // ignore optional chunks that don't exist
                    }
                }
            }
        }
    }

    /**
     * Download custom fonts from useanyfont and rewrite uaf.css.
     */
    protected function downloadUseAnyFonts(string $theme, string $baseDir): void
    {
        $uafCssPath = $baseDir.'/uploads/useanyfont/uaf.css';
        if (! File::exists($uafCssPath)) {
            return;
        }

        $content = File::get($uafCssPath);
        preg_match_all('#/wp-content/uploads/useanyfont/([a-zA-Z0-9\-_]+\.(?:woff2?|ttf|otf|eot))#i', $content, $matches);
        $fontFiles = array_unique($matches[1] ?? []);

        $targetDir = $baseDir.'/uploads/useanyfont';
        File::ensureDirectoryExists($targetDir);

        $this->info('Downloading useanyfont fonts ('.count($fontFiles).' found)...');

        foreach ($fontFiles as $fontFile) {
            $targetPath = $targetDir.'/'.$fontFile;
            if (File::exists($targetPath) && filesize($targetPath) > 0) {
                continue;
            }

            // Check sibling theme first
            $siblingThemes = ['3d-motion-05', '3d-motion-01'];
            $copied = false;
            foreach ($siblingThemes as $srcTheme) {
                if ($srcTheme === $theme) {
                    continue;
                }
                $siblingPath = public_path("themes/{$srcTheme}/uploads/useanyfont/{$fontFile}");
                if (File::exists($siblingPath) && filesize($siblingPath) > 0) {
                    File::copy($siblingPath, $targetPath);
                    $copied = true;
                    $this->line("<info>[FONT COPIED]</info> {$fontFile}");
                    break;
                }
            }

            if (! $copied) {
                try {
                    $url = "https://the.invisimple.id/wp-content/uploads/useanyfont/{$fontFile}";
                    $res = Http::withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                        'Referer' => 'https://the.invisimple.id/',
                    ])->timeout(15)->get($url);

                    if ($res->successful() && strlen($res->body()) > 0 && ! str_starts_with($res->body(), '<!DOCTYPE')) {
                        File::put($targetPath, $res->body());
                        $this->line("<info>[FONT OK]</info> {$fontFile}");
                    }
                } catch (\Throwable $e) {
                    // ignore
                }
            }
        }

        // Rewrite uaf.css to use local theme path
        $newContent = str_replace(
            '/wp-content/uploads/useanyfont/',
            "/themes/{$theme}/uploads/useanyfont/",
            $content
        );
        File::put($uafCssPath, $newContent);
    }

    /**
     * Download Font Awesome webfonts and fonts.
     */
    protected function downloadFontAwesomeWebfonts(string $theme, string $baseDir): void
    {
        $webfontsDir = $baseDir.'/plugins/elementor/assets/lib/font-awesome/webfonts';
        File::ensureDirectoryExists($webfontsDir);

        $webfonts = [
            'fa-solid-900.woff2', 'fa-solid-900.woff', 'fa-solid-900.ttf', 'fa-solid-900.eot',
            'fa-regular-400.woff2', 'fa-regular-400.woff', 'fa-regular-400.ttf', 'fa-regular-400.eot',
            'fa-brands-400.woff2', 'fa-brands-400.woff', 'fa-brands-400.ttf', 'fa-brands-400.eot',
        ];

        $this->info('Downloading Font Awesome webfonts...');
        foreach ($webfonts as $file) {
            $targetPath = $webfontsDir.'/'.$file;
            if (File::exists($targetPath) && filesize($targetPath) > 0) {
                continue;
            }

            try {
                $url = "https://the.invisimple.id/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/{$file}";
                $res = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Referer' => 'https://the.invisimple.id/',
                ])->timeout(15)->get($url);

                if ($res->successful() && strlen($res->body()) > 0 && ! str_starts_with($res->body(), '<!DOCTYPE')) {
                    File::put($targetPath, $res->body());
                    $this->line("<info>[WEBFONT OK]</info> {$file}");
                }
            } catch (\Throwable $e) {
                // ignore
            }
        }
    }

    /**
     * Download Elementor core library files like dialog.js, share-link.js, etc.
     */
    protected function downloadElementorLibs(string $theme, string $baseDir): void
    {
        $libs = [
            'plugins/elementor/assets/lib/dialog/dialog.js',
            'plugins/elementor/assets/lib/dialog/dialog.min.js',
            'plugins/elementor/assets/lib/share-link/share-link.js',
            'plugins/elementor/assets/lib/share-link/share-link.min.js',
            'plugins/elementor/assets/css/conditionals/dialog.css',
            'plugins/elementor/assets/css/conditionals/dialog.min.css',
            'plugins/elementor/assets/css/conditionals/lightbox.css',
            'plugins/elementor/assets/css/conditionals/lightbox.min.css',
        ];

        $this->info('Downloading Elementor library files...');
        foreach ($libs as $relPath) {
            $targetPath = $baseDir.'/'.$relPath;
            if (File::exists($targetPath) && filesize($targetPath) > 0) {
                continue;
            }

            File::ensureDirectoryExists(dirname($targetPath));

            try {
                $url = "https://the.invisimple.id/wp-content/{$relPath}";
                $res = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Referer' => 'https://the.invisimple.id/',
                ])->timeout(15)->get($url);

                if ($res->successful() && strlen($res->body()) > 0 && ! str_starts_with($res->body(), '<!DOCTYPE')) {
                    File::put($targetPath, $res->body());
                    $this->line("<info>[LIB OK]</info> {$relPath}");
                }
            } catch (\Throwable $e) {
                // ignore
            }
        }
    }

    /**
     * Download background videos or provide placeholder MP4 if remote is unavailable.
     */
    protected function downloadVideos(string $theme, string $baseDir): void
    {
        $viewPath = resource_path("views/demo/{$theme}.blade.php");
        if (! File::exists($viewPath)) {
            return;
        }

        $content = File::get($viewPath);
        preg_match_all('#uploads[\\\\/]+([^"\'<>\r\n]+?\.mp4)#i', $content, $matches);
        $videoRelPaths = [];
        foreach ($matches[1] ?? [] as $match) {
            $cleaned = ltrim(str_replace(['\/', '\\'], '/', $match), '/');
            $videoRelPaths[] = trim($cleaned);
        }
        $videoRelPaths = array_unique($videoRelPaths);

        if (empty($videoRelPaths)) {
            return;
        }

        $this->info('Downloading theme videos ('.count($videoRelPaths).' found)...');
        foreach ($videoRelPaths as $videoRel) {
            $targetPath = $baseDir.'/uploads/'.$videoRel;
            if (File::exists($targetPath) && filesize($targetPath) > 0) {
                continue;
            }

            File::ensureDirectoryExists(dirname($targetPath));

            $downloaded = false;
            try {
                $url = "https://the.invisimple.id/wp-content/uploads/{$videoRel}";
                $res = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Referer' => 'https://the.invisimple.id/',
                ])->timeout(30)->get($url);

                if ($res->successful() && strlen($res->body()) > 0 && ! str_starts_with($res->body(), '<!DOCTYPE')) {
                    File::put($targetPath, $res->body());
                    $downloaded = true;
                    $this->line("<info>[VIDEO OK]</info> {$videoRel}");
                }
            } catch (\Throwable $e) {
                $this->warn("[VIDEO ERR] {$videoRel}: ".$e->getMessage());
            }

            // If remote video is not downloadable, write a valid minimal mp4 container to satisfy video players
            if (! $downloaded) {
                // Minimal 28-byte MP4 ftyp box header to satisfy video container checks
                $minimalMp4 = base64_decode('AAAAHGZ0eXBpc29tAAAAAGlzb21tcDQxAAAAAG1vb3Y=');
                File::put($targetPath, $minimalMp4);
                $this->line("<comment>[VIDEO PLACEHOLDER CREATED]</comment> {$videoRel}");
            }
        }
    }
}
