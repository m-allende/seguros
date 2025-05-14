<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $modules = [
            "config" => [
                "company",
                "region",
            ],
            "access" => [
                "role",
                "user"
            ]
        ];
        $actions = ["admin", "create", "view", "edit", "delete"];

        foreach ($modules as $module => $permissions) {
            foreach ($permissions as $permission) {
                foreach ($actions as $action) {
                    $perm = Permission::where("name", "$module-$permission-$action")->first();
                    if(empty($perm)){
                        Permission::create(
                        [
                            'name' => "$module-$permission-$action"
                        ]
                    );
                    }

                }
            }
        }
        */
    }
}
