<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class empleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::statement("
                INSERT INTO EMPLE VALUES (7839,'REY','PRESIDENTE',NULL,'1991/11/17',
                            4100,NULL,10);
                INSERT INTO EMPLE VALUES (7566,'JIMÉNEZ','DIRECTOR',7839,'1991/04/02',
                                        2900,NULL,20);
                INSERT INTO EMPLE VALUES (7902,'FERNÁNDEZ','ANALISTA',7566,'1991/12/03',
                                        3000,NULL,20);
                INSERT INTO EMPLE VALUES (7369,'SÁNCHEZ','EMPLEADO',7902,'1990/12/17',
                                        1040,NULL,20);
                INSERT INTO EMPLE VALUES (7698,'NEGRO','DIRECTOR',7839,'1991/05/01',
                                        3005,NULL,30);
                INSERT INTO EMPLE VALUES (7499,'ARROYO','VENDEDOR',7698,'1990/02/20',
                                        1500,390,30);
                INSERT INTO EMPLE VALUES (7521,'SALA','VENDEDOR',7698,'1991/02/22',
                                        1625,650,30);
                INSERT INTO EMPLE VALUES (7654,'MARTÍN','VENDEDOR',7698,'1991/09/29',
                                        1600,1020,30);
                INSERT INTO EMPLE VALUES (7782,'CEREZO','DIRECTOR',7839,'1991/06/09',
                                        2885,NULL,10);
                INSERT INTO EMPLE VALUES (7788,'GIL','ANALISTA',7566,'1991/11/09',
                                        3000,NULL,20);
                INSERT INTO EMPLE VALUES (7844,'TOVAR','VENDEDOR',7698,'1991/09/08',
                                        1350,0,30);
                INSERT INTO EMPLE VALUES (7876,'ALONSO','EMPLEADO',7788,'1991/09/23',
                                        1430,NULL,20);
                INSERT INTO EMPLE VALUES (7900,'JIMENO','EMPLEADO',7698,'1991/12/03',
                                        1335,NULL,30);
                INSERT INTO EMPLE VALUES (7934,'MUÑOZ','EMPLEADO',7782,'1992/01/23',
                                        1690,NULL,10);

        ");
    }
}
