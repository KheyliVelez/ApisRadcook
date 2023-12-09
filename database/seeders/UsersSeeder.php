<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Jose Pedraza',
            'role' => 'client',
            'email' => 'jose@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Pereira',
            'role' => 'client',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        DB::table('users')->insert([
            'name' => 'Sandra Correa',
            'role' => 'client',
            'email' => 'sandra@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        DB::table('users')->insert([
            'name' => 'Ana Oliveira',
            'role' => 'client',
            'email' => 'ana@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Pablo',
            'role' => 'client',
            'email' => 'pablo@gmail.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
