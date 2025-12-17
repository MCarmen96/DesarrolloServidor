<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement("INSERT INTO products(nombre, descripcion,precio,foto) VALUES ('aceitunas',NULL,10,NULL);");
        DB::statement("INSERT INTO products(nombre, descripcion,precio,foto) VALUES ('pimientos',NULL,10,NULL);");
        DB::statement("INSERT INTO products(nombre, descripcion,precio,foto) VALUES ('tomates',NULL,10,NULL);");
        DB::statement("INSERT INTO products(nombre, descripcion,precio,foto) VALUES ('naranjas',NULL,10,NULL);");
        DB::statement("INSERT INTO products(nombre, descripcion,precio,foto) VALUES ('fresas',NULL,10,NULL);");
        DB::statement("INSERT INTO products(nombre, descripcion,precio,foto) VALUES ('chocolate',NULL,10,NULL);");
    }
}
