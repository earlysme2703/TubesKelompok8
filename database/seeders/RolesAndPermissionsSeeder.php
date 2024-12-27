<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ini role nya king!
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $kasir = Role::create(['name' => 'kasir']);
        $gudang = Role::create(['name' => 'gudang']);

        //ini daftar hak aksesnya bro
        Permission::create(['name' => 'kelola cabang']);
        Permission::create(['name' => 'kelola transaksi']);
        Permission::create(['name' => 'kelola stok']);
        Permission::create(['name' => 'kelola laporan']);

        //ntar edit biar ada commit
        $admin->givePermissionTo('kelola cabang', 'kelola transaksi', 'kelola stok barang', 'kelola laporan');
        $manager->givePermissionTo();
        $admin->givePermissionTo();    
        $admin->givePermissionTo();
        $admin->givePermissionTo();
    }
}
