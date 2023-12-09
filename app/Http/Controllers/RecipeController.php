<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

/**
 * Class RecipeController
 * @package App\Http\Controllers
 */
class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        $recipes = Recipe::paginate();

        return view('recipe.index', compact('recipes'))
            ->with('i', (request()->input('page', 1) - 1) * $recipes->perPage());
    }
    */

    public function index()
    {
        $userId = Auth::user()->id;
        $response = Http::get('http://localhost/radcookproject1/public/api/recipes/user/'.$userId);
        $statusCode = $response->getStatusCode();

        if ($statusCode != 200){
            return view('recipe.index', ['recipes' => []]);
        }

        $recipes =  json_decode($response->getBody()->getContents());

        return view('recipe.index',  compact('recipes'))
        ->with('i', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $recipe = new Recipe();
        $ingredients = Ingredient::get();

        $map = $ingredients->groupBy(function($item){
            return $item->type;
        });


        $map = $map->toArray();

        return view('recipe.create', compact('recipe', 'map'), ['error' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Recipe::$rules);
        $request['user_id'] = Auth::user()->id;

        $file = $request->file('photo');
        $destinationPath = 'uploads/recipes';
        $file->move($destinationPath, $file->getClientOriginalName());
        $request['image'] = ($destinationPath . '/' . $file->getClientOriginalName());

        $ingredients = [];
        foreach ($request->ingredients as $ingredient) {
            $ingredients[] = intval($ingredient);
        }

        $response = Http::post('http://localhost/radcookproject1/public/api/recipe/create', [
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'detail' => $request->detail,
            'user_id' =>  Auth::user()->id,
            'image' => $request->image,
            'ingredients' => $ingredients
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            $recipe = new Recipe();
            $ingredients = Ingredient::get();

            $map = $ingredients->groupBy(function($item){
                return $item->type;
            });


            $map = $map->toArray();

            return view('recipe.create', compact('recipe', 'map'), ['error' => 'No fue posible guardar la receta']);
        }

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
   /* public function show($id)
    {
        $recipe = Recipe::find($id);

        return view('recipe.show', compact('recipe'));
    }*/

    public function show($id)
    {
        $response = Http::get('http://localhost/radcookproject1/public/api/recipe/' . $id);

        $statusCode = $response->getStatusCode();

        if ($statusCode != 200) {
            return view('recipe.index', ['recipe' => []]);
        }

        $recipe =  json_decode($response->getBody()->getContents());

        return view('recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        $recipe = Recipe::find($id);

        $ingredients = Ingredient::get();

        $map = $ingredients->groupBy(function($item){
            return $item->type;
        });


        $map = $map->toArray();

        return view('recipe.edit', compact('recipe', 'map'), ['error' => '']);
    }*/

    public function edit($id)
    {
        $response = Http::get('http://localhost/radcookproject1/public/api/recipe/' . $id);

        $ingredients = Ingredient::get();
        $map = $ingredients->groupBy(function($item){
            return $item->type;
        });
        $map = $map->toArray();

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            return view('recipe.edit', compact('recipe', 'map'), ['error' => '']);
        }

        $recipe =  json_decode($response->getBody()->getContents());
        return view('recipe.edit', compact('recipe', 'map'), ['error' => '']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        request()->validate(Recipe::$rules);
        $request['user_id'] = Auth::user()->id;

        $file = $request->file('photo');
        $destinationPath = 'uploads/recipes';
        $file->move($destinationPath, $file->getClientOriginalName());
        $request['image'] = ($destinationPath . '/' . $file->getClientOriginalName());

        $ingredients = [];
        foreach ($request->ingredients as $ingredient) {
            $ingredients[] = intval($ingredient);
        }

        $response = Http::post('http://localhost/radcookproject1/public/api/recipe/'.$recipe->id.'/edit', [
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'detail' => $request->detail,
            'user_id' =>  Auth::user()->id,
            'image' => $request->image,
            'ingredients' => $ingredients
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            $ingredients = Ingredient::get();

            $map = $ingredients->groupBy(function($item){
                return $item->type;
            });


            $map = $map->toArray();

            return view('recipe.edit', compact('recipe', 'map'), ['error' => 'No fue posible actualizar la receta']);
        }

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = Http::delete('http://localhost/radcookproject1/public/api/recipe/'.$id.'/delete');
        $statusCode = $response->getStatusCode();

        if ($statusCode != 200) {
            return view('recipe.index', ['error' => 'No fue posible eliminar la receta']);
        }

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe deleted successfully');
    }
}
