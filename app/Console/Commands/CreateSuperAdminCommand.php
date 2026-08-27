<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

#[Signature('make:super-admin {--name= : Nama Super Admin} {--email= : Email Super Admin} {--password= : Password}')]
#[Description('Membuat akun user Super Admin baru untuk platform KalaUndangan')]
class CreateSuperAdminCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('=== Buat Akun Super Admin ===');

        $name = $this->option('name') ?: $this->ask('Masukkan Nama Lengkap', 'Super Administrator');
        $email = $this->option('email') ?: $this->ask('Masukkan Email', 'admin@kalaundangan.com');
        $password = $this->option('password') ?: $this->secret('Masukkan Password (default: password123)') ?: 'password123';

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        $this->newLine();
        $this->info('✅ Berhasil membuat / memperbarui User Super Admin:');
        $this->table(
            ['Field', 'Value'],
            [
                ['Nama', $user->name],
                ['Email', $user->email],
                ['Role', $user->role],
                ['Email Verified At', $user->email_verified_at],
            ]
        );

        return self::SUCCESS;
    }
}
