{{ Form::_open("Proveedor ingresado") }}

<div class="row form-proveedor">

    <div class="col-md-8 info-proveedor" >

        <table class="">

            <tr>
                <td> Nombre:</td>
                <td> {{ Form::text("nombre", "" , array())}} </td>
            </tr>

            <tr>
                <td> Direccion: </td>
                <td> {{ Form::text("direccion", "" , array())}} </td>
            </tr>

            <tr>
                <td> Nit: </td>
                <td> {{ Form::text("nit", "" , array())}} </td>
            </tr>

            <tr>
                <td> Telefono: </td>
                <td> {{ Form::text("telefono", "" , array())}} </td>
            </tr>

        </table> 

    </div>

    <div class="col-md-4">

    </div>

</div>
{{ Form::close() }}
<hr> 
<div class="row">
    <div class="col-md-6 contactos-list" >
    Lista de Contactos:
       <div class="row lista">
            <input type="text" value="" >
        </div>
    </div>

    <div class="col-md-6 contactos-body">
        {{Form::open(array('data-remote-contact'))}}
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">Nombre</div>
                <div class="col-md-7">{{ Form::text("nombre", "" , array())}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">apellido</div>
                <div class="col-md-7">{{ Form::text("apellido", "" , array())}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">direcion</div>
                <div class="col-md-7">{{ Form::text("direccion", "" , array())}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">telefono1</div>
                <div class="col-md-7">{{ Form::text("telefono1", "" , array())}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">telefono2</div>
                <div class="col-md-7">{{ Form::text("telefono2", "" , array())}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">celular</div>
                <div class="col-md-7">{{ Form::text("celular", "" , array())}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">correo</div>
                <div class="col-md-7">{{ Form::text("correo", "" , array())}}</div>
            </div>
        {{Form::close()}}
    </div>
</div>

<div class="form-footer" align="right">
    {{ Form::submit('Guardar Contacto!', array('class'=>'theme-button')) }}
    {{ Form::submit('finalizar!', array('class'=>'theme-button')) }}
</div>



<style type="text/css">

    .bs-modal .Lightbox{
        width: 850px !important;
    }

</style>
