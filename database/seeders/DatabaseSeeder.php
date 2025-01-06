<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <-- import it at the top
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::all();
        if($users->isEmpty()){
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'description' => 'ADMINISTRADOR DEL SISTEMA',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456')
            ]);
        }

        $this->call([
            RoleSeeder::class
        ]);

        $this->call([
            PermissionSeeder::class
        ]);

        $this->call([
            RegionSeeder::class
        ]);

        $this->call([
            CodeSeeder::class
        ]);
    }
}
