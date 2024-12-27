<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            // Permissions untuk manajemen pengguna
            'manage-users',
            'view-users',
            // Permissions untuk cabang
            'manage-branches',
            'view-branches',
            // Permissions untuk stok barang
            'manage-stock',
            'view-stock',
            // Permissions untuk transaksi
            'manage-transactions',
            'view-transactions',
            // Permissions untuk laporan
            'view-sales-report',
            'view-stock-report',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        
        // Assign permissions ke role
        $rolesPermissions = [
            'Admin' => $permissions, 
            'Manager' => [
                'view-sales-report',
                'view-stock-report',
                'view-branches',
                'view-users',
            ],
            'Supervisor' => [
                'view-stock',
                'manage-transactions',
                'view-transactions',
            ],
            'Kasir' => [
                'manage-transactions',
                'view-transactions',
            ],
            'Gudang' => [
                'manage-stock',
                'view-stock',
            ],
        ];

        foreach ($rolesPermissions as $role => $rolePermissions) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);
            $roleInstance->syncPermissions($rolePermissions);
        }
    

        // Role::create(['name' => 'pustakawan']);
        // Permission::create(['name' => 'edit_book']);
        // Permission::create(['name' => 'edit_user']);

        // Role::create(['name' => 'mahasiswa']);
        // Permission::create(['name' => 'view_book']);
    }
}
