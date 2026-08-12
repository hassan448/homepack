<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@homepack.com')],
            [
                'name' => env('ADMIN_NAME', 'مدير النظام'),
                'password' => env('ADMIN_PASSWORD', 'HomePack@2024'),
                'role' => UserRole::Admin,
            ],
        );
    }
}
