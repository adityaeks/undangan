<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Database\Seeders\ThemeSeeder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ThemeCatalogController extends Controller
{
    /**
     * Mengambil daftar master tema langsung dari database (Single Source of Truth).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getMasterThemes(): array
    {
        $themes = Theme::where('is_active', true)->get();

        if ($themes->isEmpty()) {
            (new ThemeSeeder)->run();
            $themes = Theme::where('is_active', true)->get();
        }

        return $themes->map(fn (Theme $theme) => $theme->toCatalogArray())
            ->values()
            ->toArray();
    }

    /**
     * Menampilkan halaman kumpulan katalog template tema undangan pernikahan.
     */
    public function index(Request $request): View
    {
        $masterThemes = self::getMasterThemes();
        $databaseThemesCount = count($masterThemes);

        return view('themes.catalog', [
            'themes' => $masterThemes,
            'databaseThemesCount' => $databaseThemesCount,
            'currentCategory' => $request->query('kategori', 'all'),
        ]);
    }
}
