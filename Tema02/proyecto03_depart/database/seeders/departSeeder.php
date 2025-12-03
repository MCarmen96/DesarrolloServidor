<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class departSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement("
        INSERT INTO `depart`(`depart_no`,`dnombre`,`loc`) VALUES
        (10,`contabilidad`,`sevilla`),
        (20,'INVESTIGACIÓN','MADRID')
        (30,'VENTAS','BARCELONA'),
        (40,'PRODUCCIÓN','BILBAO')");

    }
}
