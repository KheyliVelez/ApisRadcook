<?php

namespace App\Http\Controllers;

use App\Ingredient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

/**
 * Class IngredientController
 * @package App\Http\Controllers
 */
class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    public function index()
    {
        $ingredients = Ingredient::paginate();

        return view('ingredient.index', compact('ingredients'))
            ->with('i', (request()->input('page', 1) - 1) * $ingredients->perPage());
    }
    */

    public function index()
    {
        $response = Http::get('http://localhost/radcookproject1/public/api/ingredients');
        $statusCode = $response->getStatusCode();

        if ($statusCode != 200){
            return view('ingredient.index',  ['ingredients' => []]);
        }

        $ingredients =  json_decode($response->getBody()->getContents());

        return view('ingredient.index',  compact('ingredients'))
        ->with('i', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredient = new Ingredient();
        return view('ingredient.create', compact('ingredient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    /*
    public function store(Request $request)
    {
        request()->validate(Ingredient::$rules);

        $request['user_id'] = Auth::user()->id;
       $ingredient = Ingredient::create($request->all());

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient created successfully.');
    } */

    public function store(Request $request)
    {
        request()->validate(Ingredient::$rules);

        $response = Http::post('http://localhost/radcookproject1/public/api/ingredient/create', [
            'name' => $request->name,
            'type' => $request->type,
            'user_id' =>  Auth::user()->id
        ]);
        $statusCode = $response->getStatusCode();

        if ($statusCode != 200){
            return view('ingredient.index', ['message' => 'No fue posible crear el ingrediente']);
        }

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient created successfully.');
    }

    public function recipe(array $ingredients)
    {
        return $ingredients;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredient = Ingredient::find($id);

        return view('ingredient.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = Ingredient::find($id);

        return view('ingredient.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ingredient $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        request()->validate(Ingredient::$rules);

        $ingredient->update($request->all());

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id)->delete();

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient deleted successfully');
    }

    public function prueba(){
        $ingredient = Ingredient::all();
        return response()->json($ingredient);
    }
}
