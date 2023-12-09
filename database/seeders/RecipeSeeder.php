<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recipes')->insert([
            'name' => 'Huevos pericos',
            'category' => 'Desayunos',
            'description' => 'Los "huevos pericos" es un plato típico de la gastronomía colombiana. Se prepara principalmente con huevos batidos y mezclados con tomate y cebolla picados finamente.',
            'detail' => 'La receta está pensada para dos personas. Se necesitan dos huevos, media cebolla y un tomate. Se debe sofreir la cebolla y el tomate, cuando estos ingredientes estén listos se añaden tres huevos batidos.',
            'user_id' => 1,
            'image' => 'images/huevoperico.jpg'
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 1,
            'ingredient_id' => 1
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 1,
            'ingredient_id' => 3
        ]);

        DB::table('recipes')->insert([
            'name' => 'Arroz con leche',
            'category' => 'Entradas',
            'description' => 'El arroz con leche es un postre tradicional que se disfruta en muchas partes del mundo, con variantes regionales.',
            'detail' => 'La receta consiste en una mezcla de arroz cocido, leche, azúcar y a menudo canela, cocidos juntos hasta obtener una textura cremosa y dulce',
            'user_id' => 1,
            'image' => 'images/arrozconleche.jpg'
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 2,
            'ingredient_id' => 2
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 2,
            'ingredient_id' => 6
        ]);

        DB::table('recipes')->insert([
            'name' => 'Fríjoles antioqueños',
            'category' => 'Almuerzos',
            'description' => 'Los frijoles son un alimento básico en muchas culturas. Son legumbres ricas en proteínas y se preparan cocinándolos hasta que estén tiernos y se sirven en una variedad de platos, desde sopas hasta guarniciones.',
            'detail' => 'Se deben poner los frijoles en una olla a presión con parte del agua en que estuvieron en remojo y añadiendo más cantidad para cubrirlos perfectamente. Pasados 30 minutos, deberás destapar la olla y agregar el plátano cortado a trozos.',
            'user_id' => 2,
            'image' => 'images/frijoles.jpg'
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 3,
            'ingredient_id' => 3
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 3,
            'ingredient_id' => 4
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 3,
            'ingredient_id' => 5
        ]);

        DB::table('recipes')->insert([
            'name' => 'Arroz blanco',
            'category' => 'Almuerzos',
            'description' => 'El arroz blanco es un plato básico y versátil que consiste en granos de arroz cocidos al vapor o hervidos hasta que se vuelven tiernos y suaves',
            'detail' => 'Este plato es consumido en todo el mundo y sirve como acompañamiento ideal para una amplia variedad de platos, desde carnes y aves hasta vegetales y salsas.',
            'user_id' => 4,
            'image' => 'images/arrozblanco.jpg'
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 4,
            'ingredient_id' => 6
        ]);

        DB::table('recipes')->insert([
            'name' => 'Milanesa de cerdo',
            'category' => 'Almuerzos',
            'description' => ' La milanesa de cerdo es un plato que consiste en filetes finos de carne de cerdo empanizados y fritos hasta que estén dorados y crujientes.',
            'detail' => 'Es una deliciosa preparación que combina la ternura de la carne de cerdo con una cobertura crujiente, y es popular en muchas cocinas del mundo.',
            'user_id' => 5,
            'image' => 'images/milanesadecerdo.jpg'
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 5,
            'ingredient_id' => 11
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 5,
            'ingredient_id' => 3
        ]);

        DB::table('recipes')->insert([
            'name' => 'Puré de papa',
            'category' => 'Almuerzos',
            'description' => 'El puré de papa es un plato clásico que consiste en papas cocidas y luego aplastadas o trituradas hasta obtener una textura suave y cremosa. Es un acompañamiento versátil y reconfortante que se sirve comúnmente con otros platos como carnes y salsas.',
            'detail' => 'Es un acompañamiento versátil y reconfortante que se sirve comúnmente con otros platos como carnes y salsas.',
            'user_id' => 5,
            'image' => 'images/purepapa.jpg'
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 6,
            'ingredient_id' => 7
        ]);
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 6,
            'ingredient_id' => 2
        ]);
    }
}
