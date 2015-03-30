{{ Form::_open("Proveedor actualizado") }}
    
    {{ Form::hidden('id', @$model->id) }}

    {{ Form::_text('nombre', @$model->nombre) }}

    {{ Form::_text('direccion', @$model->direccion) }}
  
    {{ Form::_text('telefono', @$model->telefono) }}

    {{ Form::_text('contacto', @$model->contacto) }}

    {{ Form::_text('telefono_contacto', @$model->telefono_contacto, 'Telefono') }}

    {{ Form::_submit('Enviar') }}

{{ Form::close() }}