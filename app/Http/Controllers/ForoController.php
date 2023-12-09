<?php

namespace App\Http\Controllers;

use App\Models\foro;
use Illuminate\Http\Request;

class ForoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function prueba2()
    {
        $foro = Foro::all();
        print($foro);
        return request()->json($foro);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(foro $foro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, foro $foro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(foro $foro)
    {
        //
    }
}
