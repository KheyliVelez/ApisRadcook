<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class IngredientController
 * @package App\Http\Controllers
 */
class LoginV2Controller extends Controller
{

    public function showLoginForm() {
        return view('auth.login', ['status' => '', 'user' => null]);
    }

    public function showRegistrationForm() {
        return view('auth.register', ['error' => null]);
    }

    public function login(Request $request)
    {
        $response = Http::post('http://localhost/radcookproject1/public/api/login/v2', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        $statusCode = $response->getStatusCode();
        $body = json_decode($response->getBody()->getContents());

        if ($statusCode != 200) {
            return view('auth.login', ['status' => 'Credenciales inválidas']);
        }

       $request['token'] = $body->access_token;
       $user = JWTAuth::parseToken()->authenticate();
       Auth::login($user, true);

       $ingredients = Ingredient::get();
        $map = $ingredients->groupBy(function($item){
            return $item->type;
        });

       // Todas las recetas
       $response = Http::get('http://localhost/radcookproject1/public/api/recipes');

       if ($response->getStatusCode() != 200) {
        return view('welcome', [
            'user' => $user,
            'success' => true,
            'recipes' => [],
            'ingredients' => $ingredients,
            'map' => $map
            ]
        );
       }

        return view('welcome', [
            'user' => $user,
            'success' => true,
            'recipes' => json_decode($response->getBody()->getContents()),
            'ingredients' => $ingredients,
            'map' => $map
            ]
        );
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password', 'password_confirmation');

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return view('auth.register', [
                'error' => $validator->messages(),
                'success' => false
                ]
            );
        }

        $response = Http::post('http://localhost/radcookproject1/public/api/user/create/v2', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ]);

        if ($response->getStatusCode() != 200) {
            return view('auth.register', [
                'error' => 'Ocurrió un error',
                'success' => false
                ]
            );
        }

        $response = Http::post('http://localhost/radcookproject1/public/api/login/v2', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        $statusCode = $response->getStatusCode();
        $body = json_decode($response->getBody()->getContents());

        if ($statusCode != 200) {
            return view('auth.login', ['status' => 'Credenciales inválidas']);
        }

       $request['token'] = $body->access_token;
       $user = JWTAuth::parseToken()->authenticate();
       Auth::login($user, true);

        return view('home', [
            'user' => $user,
            'success' => true
            ]
        );
    }

    public function logout(Request $request)
    {
        /*
        return Auth::user()->getRememberToken();
        $response = Http::post('http://localhost/radcookproject1/public/api/logout', [
            'token' => JWTAuth::getToken()
        ]);

        $statusCode = $response->getStatusCode();
        $body = json_decode($response->getBody()->getContents());

        if ($statusCode != 200) {
            return view('home', ['status' => 'No fue posible cerrar sesión']);
        }

        return view('home', [
            'user' => null,
            'success' => true
            ]
        );*/

        Auth::guard()->logout();
        return view('auth.login', ['status' => '', 'user' => null]);
    }
}
