<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Code;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $codes = Code::all();
        if($codes->isEmpty()){
            DB::table('codes')->insert(['type' => "document",'name'=> "Póliza",'usage'=> 1,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "document",'name'=> "Endoso de Aumento",'usage'=> 2,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "document",'name'=> "Endoso de Corte",'usage'=> 3,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "document",'name'=> "Endoso de Disminución",'usage'=> 4,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "document",'name'=> "Endoso de Modificación",'usage'=> 5,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "document",'name'=> "Endoso de Rehabilitacion",'usage'=> 6,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "company",'name'=> "Generales",'usage'=> 1,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "company",'name'=> "Vida",'usage'=> 2,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "company",'name'=> "Rentas Vitalicias",'usage'=> 3,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "company",'name'=> "Salud",'usage'=> 4,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "ramo",'name'=> "No Vehiculo",'usage'=> 1,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "ramo",'name'=> "Vehiculo",'usage'=> 2,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "ramo",'name'=> "Vida",'usage'=> 3,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura",'name'=> "Cobertura",'usage'=> 1,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura",'name'=> "Adicional",'usage'=> 2,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura",'name'=> "Descuento",'usage'=> 3,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura",'name'=> "Recargo",'usage'=> 4,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura",'name'=> "Ajuste a Prima Minima",'usage'=> 5,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura_expressed_in",'name'=> "Porcentaje",'usage'=> 1,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura_expressed_in",'name'=> "x1000",'usage'=> 2,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "cobertura_expressed_in",'name'=> "Importe",'usage'=> 3,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "marital_status",'name'=> "Soltero" ,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "marital_status",'name'=> "Casado",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "marital_status",'name'=> "Viudo",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "marital_status",'name'=> "Divorciado" ,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "gender",'name'=> "Masculino",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "gender",'name'=> "Femenino",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "person",'name'=> "Persona",'usage'=> 1,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "person",'name'=> "Empresa",'usage'=> 2,'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "person_carat",'name'=> "Contratante",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "person_carat",'name'=> "Facturar a",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "person_carat",'name'=> "Acreedor", 'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "person_item",'name'=> "Asegurado",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "person_item",'name'=> "Deudor",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "intermediary",'name'=> "Corredor",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "intermediary",'name'=> "Intermediario 1",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "intermediary",'name'=> "Intermediario 2",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "intermediary",'name'=> "Intermediario 3",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "intermediary",'name'=> "Intermediario 4",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "intermediary",'name'=> "Intermediario 5",'created_at' => now(),'updated_at' => now()]);
            DB::table('codes')->insert(['type' => "intermediary",'name'=> "Intermediario 6",'created_at' => now(),'updated_at' => now()]);
        }
    }
}
