
{{ Form::open(array('data-remote-md', 'data-success' => 'Compra Generada')) }}

<div class="row">

	<div class="col-md-6 master-detail-info">
		{{ Form::hidden('proveedor_id') }}
		<table class="master-table">
			<tr>
				<td>Proveedor:</td>
				<td>
					<input type="text" id="proveedor_id"> 
					<i class="fa fa-question-circle btn-link theme-c" id="proveedor_help"></i>
					<i class="fa fa-pencil btn-link theme-c" id="proveedor_edit"> </i>
					<i class="fa fa-plus-square btn-link theme-c" id="proveedor_create"></i>
				</td>
			</tr>
			<tr>
				<td>Factura No.: </td>
				<td> <input type="text" name="numero_documento"> </td>
			</tr>
			<tr>
				<td> Fecha de Doc.:</td>
				<td><input type="text" name="fecha_documento" data-value="now()">  </td>
			</tr>
		</table>
	</div>

	<div class="col-md-6 search-proveedor-info">  </div>

</div>

<div class="form-footer" align="right">
	{{ Form::submit('Ok!', array('class'=>'theme-button')) }}
</div>

{{ Form::close() }}

<div class="master-detail"> 
	<div class="master-detail-body"></div>
	{{ Form::hidden('compra_id') }}
</div>

<script>

	$(function() {
		$("#proveedor_id").autocomplete({
			source: function (request, response) {
				$.ajax({
					url: "user/buscar_proveedor",
					dataType: "json",
					data: request,
					success: function (data) {
						response(data);
					},
					error: function () {
						response([]);
					}
				});
			},
			minLength: 3,
			select:function( data, ui ){
				$("input[name='proveedor_id']").val(ui.item.id);
				$(".search-proveedor-info").html('<strong>Direccion:  '+ui.item.descripcion+'</strong><br><strong>Contacto:   '+ui.item.value+'</strong>');
			},
			autoFocus: true,
			open: function(event, ui) {
				$(".ui-autocomplete").css("z-index", 100000);
			}
		});
	});

	$('form[data-remote-md] input[name="fecha_documento"]').pickadate(
	{
		max: true,
		disable: [7]
	});

</script>
