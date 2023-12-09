<?php

namespace App\Http\Controllers\Api;

use App\Ingredient;
use App\Models\User;
use App\Recipe;
use App\RecipeIngredient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

class RecipeController extends BaseController
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'detail' => ['required', 'string'],
            'user_id' =>['required', 'integer'],
            'image' => ['required', 'string', 'max:255'],
            'ingredients' => ['required', 'array']
        ]);
    }

    public function create(Request $request){
        $validator = $this->validator($request->all());

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $user = User::find($request->user_id);

        if ($user == null){
            return response()->json(['status' => 'user not found'], response::HTTP_BAD_REQUEST);
        }

        foreach ($request->ingredients as $id){
            $ingredient = Ingredient::find($id);

            if ($ingredient == null){
                return response()->json(['message' => 'ingredient not found'], response::HTTP_BAD_REQUEST);
            }
        }

        $recipe = Recipe::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'detail' => $request->detail,
            'user_id' =>$user->id,
            'image' => $request->image
        ]);

        if ($recipe == null) {
            return response()->json(['status' => 'error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $recipe->ingredients()->attach($request->ingredients);

        return response()->json(['status' => 'ok'], Response::HTTP_OK);
    }

    public function getAll(){
        $recipes = Recipe::all();

        if ($recipes->count() == 0){
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        foreach ($recipes as $recipe) {
            $recipe->ingredients;
        }

        return response()->json($recipes, response::HTTP_OK);
    }

    public function getById(Int $id){

        $recipe = Recipe::find($id);

        if ($recipe == null){
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        $recipe->ingredients->groupBy('type');
        return response()->json($recipe, response::HTTP_OK);
    }

    public function update(Request $request, int $id){
        $validator = $this->validator($request->all());

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $recipe = Recipe::find($id);
        if ($recipe == null){
            return response()->json(['status' => 'recipe not_found'], Response::HTTP_NOT_FOUND);
        }

        $user = User::find($request->user_id);
        if ($user == null){
            return response()->json(['status' => 'user not_found'], Response::HTTP_NOT_FOUND);
        }

        if($recipe->user_id != $user->id){
            return response()->json(['status' => 'action not allowed'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        foreach ($request->ingredients as $id) {
            $ingredient = Ingredient::find($id);

            if ($ingredient == null){
                return response()->json(['message' => 'ingredient not found'], response::HTTP_BAD_REQUEST);
            }
        }

        foreach ($recipe->ingredients as $ingredient) {
            $recipe->ingredients()->detach($ingredient->id);
        }

        $ok=$recipe->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'detail' => $request->detail,
            'image' => $request->image
        ]);

        if ($ok == false){
            return response()->json(['status' => 'unexpected error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $recipe->ingredients()->attach($request->ingredients);

        return response()->json(['status' => 'update successed'], Response::HTTP_OK);
    }

    public function destroy(Int $id)
    {
        $recipe = Recipe::find($id);

        if ($recipe == null) {
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        $recipe->delete();

        return response()->json(['status' => 'success', 'message' => 'Recipe delete successfully'], Response::HTTP_OK);
    }

    public function getByUserId(int $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return response()->json(['status' => 'user not_found'], Response::HTTP_NOT_FOUND);
        }

        $recipes = $user->recipes;

        return response()->json($recipes, response::HTTP_OK);
    }
}
