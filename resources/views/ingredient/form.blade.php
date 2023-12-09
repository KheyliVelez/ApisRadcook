<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('name', $ingredient->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre ingrediente']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <!--
            <div class="form-group">
            {{ Form::label('type') }}
            {{ Form::text('type', $ingredient->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        -->
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::select('type',  [
            'Fruta'=>'Fruta', 
            'Verdura'=>'Verdura', 
            'Carne' => 'Carne',
            'Pescado' => 'Pescado',
            'Lácteos' => 'Lácteos',
            'Cereales' => 'Cereales',
            'Legumbres' => 'Legumbres',
            'Hierbas y Especias' => 'Hierbas y Especias',
            'Aceites y Grasas' => 'Aceites y Grasas',
            'Frutos Secos' => 'Frutos Secos',
            'Mariscos' => 'Mariscos',
            'Huevos' => 'Huevos',
            'Salsas' => 'Salsas',
            'Bebidas' => 'Bebidas',
            'Postres' => 'Postres',
            'Pan y Panadería' => 'Pan y Panadería',
            'Dulces' => 'Dulces',
            'Condimentos' => 'Condimentos',
            'Café y Té' => 'Café y Té',
            'Congelados' => 'Congelados'], $ingredient->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona tipo de ingrediente']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-success">{{ __('Aceptar') }}</button>
    </div>
</div>
