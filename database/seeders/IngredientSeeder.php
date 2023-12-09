<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            'name' => 'Huevos',
            'type' => 'Huevos',
            'user_id' => 1
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Leche',
            'type' => 'Lácteos',
            'user_id' => 1
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Tomate',
            'type' => 'Fruta',
            'user_id' => 1
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Queso',
            'type' => 'Lácteos',
            'user_id' => 2
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Camaron',
            'type' => 'Mariscos',
            'user_id' => 2
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Arroz',
            'type' => 'Cereales',
            'user_id' => 2
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Papa',
            'type' => 'Tubérculos',
            'user_id' => 2
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pasta',
            'type' => 'Cereales',
            'user_id' => 3
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Atún',
            'type' => 'Pescado',
            'user_id' => 3
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Banano',
            'type' => 'Fruta',
            'user_id' => 4
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Lomo de cerdo',
            'type' => 'Carne',
            'user_id' => 5
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pechuga de pollo',
            'type' => 'Carne',
            'user_id' => 5
        ]);
    }
}
