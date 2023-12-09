<?php

namespace App\Http\Controllers\Api;

use App\Ingredient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\json_decode;

class IngredientController extends BaseController
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:ingredients'],
            'type' => ['required', 'string', 'max:255'],
            'user_id' =>['required', 'integer']
        ]);
    }

    public function create(Request $request){
        $validator = $this->validator($request->all());

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $user = User::find($request->user_id);

        if ($user == null){
            return response()->json(['status' => 'error'], response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $ingredient = Ingredient::create([
            'name' => $request->name,
            'type' => $request->type,
            'user_id' =>$user->id
        ]);

        if ($ingredient != null) {
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }

        return response()->json(['status' => 'error'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function getAll(Request $request){
        $ingredients = Ingredient::all();

        if ($ingredients->count() == 0){
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($ingredients, response::HTTP_OK);
    }

    public function getById(Int $id){

        $ingredient = Ingredient::find($id);

        if ($ingredient == null){
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($ingredient, response::HTTP_OK);
    }

    public function getRecipesByIngredient(int $id){
        $ingredient = Ingredient::find($id);
        if ($ingredient == null){
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($ingredient->recipes, Response::HTTP_OK);
    }

    public function getRecipesByIngredientV2(Request $request){
        $validator = Validator::make($request->all(), [
            'ingredients' => ['required', 'array']
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }


        $recipes = array();
        $recipesToReturn = array();
        $ingredients = Ingredient::whereIn('id', $request->ingredients)->get();
        foreach ($ingredients as $ingredient) {
            $in = Ingredient::find($ingredient['id']);

            foreach ($in->recipes as $rece) {
                $already = false;
                foreach ($recipesToReturn as $rtr) {
                    if ($rece->id == $rtr->id) {
                        $already = true;
                    }
                }

                if (!$already) {
                    array_push($recipesToReturn, $rece);
                }
            }
        }

        if (count($recipesToReturn)== 0){
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($recipesToReturn, Response::HTTP_OK);
    }
}
