<div class="row">

	<div class="col-md-6">
	    {{ Form::open(array('data-remote-md-d', 'data-success' => 'Venta Generada')) }}
			{{ Form::hidden('producto_id') }}
			{{ Form::hidden('serials') }}
			<table class="master-table">
				<tr>
					<td>
						Codigo: 
						<i class="fa fa-search btn-link theme-c" id="md-search"></i>
					</td>
					<td>Cantidad:</td>
					<td>Precio:</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="search_producto"> 
					</td>
					<td><input type="text" name="cantidad"> </td>
					<td><input type="text" name="precio" id="venta_save_producto"> </td>
					<td>
						<button type="button" class="btn btn-default btn-lg" id="serial-venta">
							<span class="glyphicon glyphicon-barcode" aria-hidden="true" ></span>
						</button>
					</td>
				</tr>
			</table>
	    {{ Form::close() }}
	</div>

	<div class="col-md-6">
		<div class="row master-precios">
			<div class="col-md-4 precio-publico" style="text-align:center;"> </div>
			<div class="col-md-3 existencia" style="text-align:right;"> </div>
		</div>
		<div class="row master-descripcion">
			<div class="col-md-11 descripcion"></div>
		</div>
	</div>

</div>

<div class="body-detail"> </div>

<div class="form-footer" align="right">
	<div class="">
		{{Form::button('Eliminar!', ['class'=>'btn btn-warning','onClick'=>'DeleteVentaInicial();']);}}
		{{ Form::button('Finalizar!', ['class'=>'btn btn-info theme-button']) }}
	</div>
</div>
