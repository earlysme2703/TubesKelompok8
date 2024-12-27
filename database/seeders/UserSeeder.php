<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => 'password',
                'role' => 'Admin',
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => 'password',
                'role' => 'Manager',
            ],
            [
                'name' => 'Supervisor User',
                'email' => 'supervisor@example.com',
                'password' => 'password',
                'role' => 'Supervisor',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate([
                'email' => $userData['email'],
            ], [
                'name' => $userData['name'],
                'password' => $userData['password'],  // Password tanpa hash
            ]);

            // Menambahkan role ke pengguna
            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
