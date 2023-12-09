<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UtilsController extends Controller
{
    public function recipe(Request $request)
    {
        $ingredients = [];
        foreach ($request->ingredients as $id) {
            $ingredients[] = intval($id);
        }

        $response = Http::get('http://localhost/radcookproject1/public/api/ingredients/recipes', [
            'ingredients' => $ingredients
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            return;
        }

         // Todos los ingredientes
       $ingredients = Ingredient::get();
       $map = $ingredients->groupBy(function($item){
           return $item->type;
       });

        return view('welcome', [
            'user' => Auth::user(),
            'success' => true,
            'ingredients' => $ingredients,
            'map' => $map,
            'recipes' => json_decode($response->getBody()->getContents())
            ]
        );
    }
}
