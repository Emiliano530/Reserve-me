<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(30)
            ->create()
            ->each(function ($user) {
                $user->assignRole('user');
            });

        // Crear el usuario "admin" y asignarle el rol "admin"
        $adminUser = User::create([
            'name' => 'Admin',
            'lastName' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password', // password
            'role' => '1'
        ]);

        $adminRole = ModelsRole::where('name', 'admin')->first();
        $adminUser->assignRole($adminRole);
    }
}
