@extends('layouts.app')

@section('template_title')
    {{ $recipe->name ?? "{{ __('Show') Recipe" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Receta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-success" href="{{ route('recipes.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $recipe->name }}
                        </div>
                        <div class="form-group">
                            <strong>Categoría:</strong>
                            {{ $recipe->category }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $recipe->description }}
                        </div>
                        <div class="form-group">
                            <strong>Pasos:</strong>
                            {{ $recipe->detail }}
                        </div>
                        <div class="form-group">
                            <strong>Imagen</strong>
                            <img src="{{ asset($recipe->image) }}" alt="" width="300" height="200" style="border-radius: 10px;">
                        </div>

                        <div class="box box-info padding-1">
                            <div class="box-body">
                                <strong>Ingredientes</strong>
                                <ul class="list-group">
                                    @foreach($recipe->ingredients as $i => $ingredient)
                                        <li class="list-group-item"> {{$ingredient->name}}</li>
                                    @endforeach

                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
