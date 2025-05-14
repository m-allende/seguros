<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = Menu::all();
        if($menus->isEmpty()){
            DB::table('menus')->insert(['parent_id' => null, 'icon' => null , 'name' => 'managment-insurances' , 'url' => null , 'permission' => '', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => null, 'icon' => null , 'name' => 'managment-pays' , 'url' => null , 'permission' => '', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => null, 'icon' => null , 'name' => 'settings' , 'url' => null , 'permission' => '', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 1, 'icon' => 'fa-regular fa-clipboard' , 'name' => 'creations' , 'url' => null , 'permission' => '', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 1, 'icon' => 'ri-dashboard-2-line' , 'name' => 'modifications' , 'url' => null , 'permission' => '', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 1, 'icon' => 'ri-dashboard-2-line' , 'name' => 'reports' , 'url' => null , 'permission' => '', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 2, 'icon' => 'ri-dashboard-2-line' , 'name' => 'documentation' , 'url' => null , 'permission' => '', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 2, 'icon' => 'ri-dashboard-2-line' , 'name' => 'pays' , 'url' => null , 'permission' => '', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 2, 'icon' => 'ri-dashboard-2-line' , 'name' => 'reports' , 'url' => null , 'permission' => '', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 3, 'icon' => 'fa-solid fa-gear' , 'name' => 'settings' , 'url' => '/config/principal' , 'permission' => 'setting', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 10, 'icon' => 'fa-solid fa-gears' , 'name' => 'general' , 'url' => null , 'permission' => '', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 10, 'icon' => 'fa-solid fa-gears' , 'name' => 'insurance' , 'url' => null , 'permission' => '', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 10, 'icon' => 'fa-solid fa-gears' , 'name' => 'vehicles' , 'url' => null , 'permission' => '', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 10, 'icon' => 'fa-solid fa-gears' , 'name' => 'insured-goods' , 'url' => null , 'permission' => '', 'order' =>4 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 10, 'icon' => 'fa-solid fa-gears' , 'name' => 'access' , 'url' => null , 'permission' => '', 'order' =>5 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 4, 'icon' => null , 'name' => 'create-quote' , 'url' => '/coti/create' , 'permission' => 'quote', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 4, 'icon' => null , 'name' => 'create-proposal' , 'url' => '/prop/create' , 'permission' => 'proposal', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 4, 'icon' => null , 'name' => 'create-document' , 'url' => '/docu/create' , 'permission' => 'document', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 5, 'icon' => null , 'name' => 'modify-quote' , 'url' => '/coti/edit' , 'permission' => '', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 5, 'icon' => null , 'name' => 'modify-proposal' , 'url' => '/prop/edit' , 'permission' => '', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 11, 'icon' => 'fa-solid fa-check' , 'name' => 'general' , 'url' => '/config/settings' , 'permission' => 'settings', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 11, 'icon' => 'fa-solid fa-check' , 'name' => 'types' , 'url' => '/config/type' , 'permission' => 'type', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 11, 'icon' => 'fa-solid fa-check' , 'name' => 'coin' , 'url' => '/config/coin' , 'permission' => 'coin', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 11, 'icon' => 'fa-solid fa-check' , 'name' => 'region' , 'url' => '/config/region' , 'permission' => 'region', 'order' =>4 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 11, 'icon' => 'fa-solid fa-check' , 'name' => 'city' , 'url' => '/config/city' , 'permission' => 'city', 'order' =>5 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 11, 'icon' => 'fa-solid fa-check' , 'name' => 'commune' , 'url' => '/config/commune' , 'permission' => 'commune', 'order' =>6 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 12, 'icon' => 'fa-solid fa-check' , 'name' => 'company' , 'url' => '/config/company' , 'permission' => 'company', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 12, 'icon' => 'fa-solid fa-check' , 'name' => 'ramo' , 'url' => '/config/ramo' , 'permission' => 'ramo', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 12, 'icon' => 'fa-solid fa-check' , 'name' => 'product' , 'url' => '/config/product' , 'permission' => 'product', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 12, 'icon' => 'fa-solid fa-check' , 'name' => 'executive' , 'url' => '/config/executive' , 'permission' => 'executive', 'order' =>4 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 13, 'icon' => 'fa-solid fa-check' , 'name' => 'color' , 'url' => '/config/color' , 'permission' => 'color', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 13, 'icon' => 'fa-solid fa-check' , 'name' => 'type-vehicle' , 'url' => '/config/typevehicle' , 'permission' => 'typevehicle', 'order' =>2 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 13, 'icon' => 'fa-solid fa-check' , 'name' => 'use-vehicle' , 'url' => '/config/usevehicle' , 'permission' => 'usevehicle', 'order' =>3 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 13, 'icon' => 'fa-solid fa-check' , 'name' => 'brand-vehicle' , 'url' => '/config/brandvehicle' , 'permission' => 'brandvehicle', 'order' =>4 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 13, 'icon' => 'fa-solid fa-check' , 'name' => 'model-vehicle' , 'url' => '/config/modelvehicle' , 'permission' => 'modelvehicle', 'order' =>5 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 14, 'icon' => 'fa-solid fa-check' , 'name' => 'insured-goods' , 'url' => '/config/insuredgoods' , 'permission' => 'insuredgoods', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 15, 'icon' => 'fa-solid fa-check' , 'name' => 'role' , 'url' => '/access/role' , 'permission' => 'role', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
            DB::table('menus')->insert(['parent_id' => 15, 'icon' => 'fa-solid fa-check' , 'name' => 'user' , 'url' => '/access/user' , 'permission' => 'user', 'order' =>1 , 'enabled' => 1 , 'created_at' => now(), 'updated_at' => now()]);
        }

        if (!DB::table('menus')->where('url', '/config/deductible')->exists()) {
            DB::table('menus')->insert([
                'parent_id'   => 12,
                'icon'        => 'fa-solid fa-check',
                'name'        => 'deductible',
                'url'         => '/config/deductible',
                'permission'  => 'deductible',
                'order'       => 5,
                'enabled'     => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
