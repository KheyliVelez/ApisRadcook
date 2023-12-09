@extends('layouts.app')

@section('template_title')
    Recipe
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Receta') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('recipes.create') }}" class="btn btn-success btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nueva receta') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
										<th>Nombre</th>
										<th>Categoría</th>
										<th>Descripción</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recipes as $recipe)
                                        <tr>
											<td>{{ $recipe->name }}</td>
											<td>{{ $recipe->category }}</td>
											<td>{{ $recipe->description }}</td>

                                            <td>
                                                <form action="{{ route('recipes.destroy',$recipe->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('recipes.show',$recipe->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('recipes.edit',$recipe->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
