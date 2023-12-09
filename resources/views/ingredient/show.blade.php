@extends('layouts.app')

@section('template_title')
    {{ $ingredient->name ?? "{{ __('Show') Ingredient" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Ingrediente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-success" href="{{ route('ingredients.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $ingredient->name }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $ingredient->type }}
                        </div>
                        <div class="form-group">
                            <strong>Id de usuario:</strong>
                            {{ $ingredient->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
