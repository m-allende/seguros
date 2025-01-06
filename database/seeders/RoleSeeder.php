<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        if($roles->isEmpty()){
            //se crea el rol de "super-admin"
            DB::table('roles')->insert([
                'name' => "super-admin",
                'guard_name'=> "web",
                'created_at' => now(),
                'updated_at' => now()
            ]);
            //se busca el primer usuario
            $user = User::find(1);
            //se le asigan el rol
            $user->assignRole('super-admin');
        }

        $roles = Role::where("name","=","user")->get();
        if($roles->isEmpty()){
            //se crea el rol de "usuario"
            DB::table('roles')->insert([
                'name' => "user",
                'guard_name'=> "web",
                'created_at' => now(),
                'updated_at' => now()
            ]);
            //se buscan todos los usuarios
            $users = User::get();
            //se le asigan el rol "user" a los usuarios que no tengan rol
            foreach ($users as $user) {
                if(!$user->hasRole("super-admin")){
                    $user->assignRole('user');
                }
            }
        }

    }
}
