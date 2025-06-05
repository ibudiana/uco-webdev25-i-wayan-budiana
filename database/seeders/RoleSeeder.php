<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah role sudah ada agar tidak duplikat
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Buat atau ambil user admin (misalnya berdasarkan email)
        $admin = User::firstOrCreate(
            ['email' => 'ibudiana@student.ciputra.ac.id'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );

        // Assign role admin ke user tersebut
        $admin->assignRole($adminRole);

        // Optional: buat user biasa
        $user = User::firstOrCreate(
            ['email' => 'yan.budiana@gmail.com'],
            ['name' => 'User', 'password' => bcrypt('password')]
        );

        // Assign role user
        $user->assignRole($userRole);
    }
}
