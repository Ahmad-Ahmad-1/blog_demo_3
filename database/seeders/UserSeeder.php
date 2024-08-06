<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'Admin 1',
            'email' => 'admin@example.com',
        ]);
        $user1->assignRole('Admin');

        $user2 = User::factory()->create([
            'name' => 'Super Admin 1',
            'email' => 'superadmin@example.com',
        ]);
        $user2->assignRole('Super Admin');
    }
}
