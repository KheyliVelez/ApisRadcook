<?php

namespace App\Http\Controllers\Api;

use App\Ingredient;
use App\Models\Foro;
use App\Models\User;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class ForoController extends BaseController
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' =>['required', 'integer'],
            'description' => ['required', 'string']
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

        $foro = Foro::create([
            'user_id' =>$user->id,
            'description' => $request->description
        ]);

        if ($foro == null) {
            return response()->json(['status' => 'error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['status' => 'ok'], Response::HTTP_OK);
    }

    public function getAll(){
        $foros = Foro::all();

        if ($foros->count() == 0){
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($foros, response::HTTP_OK);
    }

    public function getByUserId(int $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return response()->json(['status' => 'user not_found'], Response::HTTP_NOT_FOUND);
        }

        $foros = $user->posts;

        return response()->json($foros, response::HTTP_OK);
    }

    public function destroy(Int $id)
    {
        $foro = Foro::find($id);

        if ($foro == null) {
            return response()->json(['status' => 'not_found'], Response::HTTP_NOT_FOUND);
        }

        $foro->delete();

        return response()->json(['status' => 'success', 'message' => 'Post deleted successfully'], Response::HTTP_OK);
    }
}
