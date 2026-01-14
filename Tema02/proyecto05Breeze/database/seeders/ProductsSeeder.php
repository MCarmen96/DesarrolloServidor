<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::insert("INSERT INTO products(id, name, description, price, available, product_type, image, time, date, created_at, updated_at) VALUES (1, 'Menu Invierno', 'Muchas cosas en este menu', 12.30, TRUE, 'menu', '/storage/img/menu2dic2025.png', '12:43', '2025-12-02', '2026-01-01 10:24:15', '2026-01-01 10:24:15')");

        DB::insert("INSERT INTO products(id, name, description, price, available, product_type, image, time, date, created_at, updated_at) VALUES (2, 'Pastel de patata', 'Es un pastel con patatas', 5.00, TRUE, 'dish', NULL, '15:23', '2026-02-12', '2026-01-12 13:04:19', '2026-01-12 13:04:19')");

        DB::insert("INSERT INTO products(id, name, description, price, available, product_type, image, time, date, created_at, updated_at) VALUES (3, 'Pavlova de Frutos Rojos', 'Algo muy raro', 4.00, TRUE, 'dish', NULL, '11:12', '2025-12-12', '2026-01-12 13:06:39', '2026-01-12 13:06:39')");

        DB::insert("INSERT INTO products(id, name, description, price, available, product_type, image, time, date, created_at, updated_at) VALUES (4, 'Solomillo de Cerdo Stroganoff', 'No se', 4.00, TRUE, 'dish', NULL, '11:30', '2025-12-12', '2026-01-12 13:06:39', '2026-01-12 13:06:39')");

        DB::insert("INSERT INTO products(id, name, description, price, available, product_type, image, time, date, created_at, updated_at) VALUES (5, 'Menu Noviembre 11', 'Un menu con muchas cosas', 123.00, TRUE, 'menu', '/storage/img/menu11Nov2025.png', '12:32', '2025-11-11', '2026-01-12 13:18:34', '2026-01-12 13:18:34')");

        DB::insert("INSERT INTO products(id, name, description, price, available, product_type, image, time, date, created_at, updated_at) VALUES (6, 'Menu Noviembre 25', 'Un menu con muchas cosas', 32.43, TRUE, 'menu', '/storage/img/menu25Nov2025.png', '12:32', '2025-11-25', '2026-01-12 13:18:34', '2026-01-12 13:18:34')");
    }
}
