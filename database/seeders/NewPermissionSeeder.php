<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;

class NewPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = ["admin", "create", "view", "edit", "delete"];

        $menus = Menu::whereNotNull("url")->where("url", "!=", "#")->get();
        $rol = Role::where("name", "super-admin")->first();
        foreach ($menus as $menu) {
            $id= $menu->permission;
            foreach ($actions as $action) {
                $perm = Permission::where("name", "$id-$action")->first();
                if(empty($perm)){
                    Permission::create(['name' => "$id-$action"]);
                    $rol->givePermissionTo("$id-$action");
                }
            }
        }
        //se actualiza el rol a los usuarios que tengan el rol de super-admin
        $users = User::where("role_id", $rol->id)->get();
        foreach ($users as $user) {
            $user->assignRole('super-admin');
        }
    }
}
