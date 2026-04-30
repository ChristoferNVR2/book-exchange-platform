<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@bookexchange.local'],
            [
                'username' => 'admin',
                'password' => bcrypt(env('ADMIN_SEED_PASSWORD', 'admin123')),
                'role'     => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'alice@example.com'],
            [
                'username' => 'alice',
                'password' => bcrypt('user123'),
                'role'     => 'user',
            ]
        );
    }
}
