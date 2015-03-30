
{{ Form::open(array('data-remote-md', 'data-success' => $message, 'method' =>'post', 'role'=>'form', 'class' => 'form-horizontal')) }}

    <input name="{{$name}}" value="{{$id}}" type="text" class="hide">

    <div class="form-group">
        {{ Form::label('body', 'Descripcion', array('class'=>'control-label margin-left-10')) }}
        {{ Form::label('body', 'Monto', array('class'=>'control-label margin-left-212')) }}
        {{ Form::label('body', 'Metodo de pago', array('class'=>'control-label margin-left-100')) }}
    </div>
    
    <div class="form-group">
        <div class="col-lg-6"> 
            <input name="descripcion" type="text" class="form-control" autocomplete="off">
        </div>

        <div class="col-lg-3"> 
            <input name="monto" type="text" class="form-control number" autocomplete="off">
        </div>
        <div class="col-lg-3">                               
            <select name="metodo_pago_id" class="form-control">
                <option value="1">Efectivo</option>
                <option value="2">Cheque</option>
                <option value="3">Deposito</option>
                <option value="4">Tarjeta</option>
                <option value="4">Credito</option>
            </select>  
        </div>
    </div>

    <div class="master-detail">
    </div>

    {{ Form::_submit() }}

{{ Form::close() }}