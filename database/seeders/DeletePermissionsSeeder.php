<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class DeletePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        para ejecutar la eliminacion, se debe usar esta sentencia:
        php artisan db:seed --class=DeletePermissionsSeeder
        */
        DB::table('model_has_permissions')->truncate(); // Elimina las relaciones de permisos con los modelos
        DB::table('model_has_roles')->truncate(); // Elimina las relaciones de roles con los modelos


        // Desactivar las claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_has_permissions')->truncate(); // Elimina las relaciones de roles con los permisos
        // Elimina todos los permisos de la base de datos
        Permission::truncate();

        // Reactivar las claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Si deseas también eliminar los roles asociados (opcional)
        // Puedes usar el método truncate() para eliminar todos los roles
        // \Spatie\Permission\Models\Role::truncate();
    }
}
