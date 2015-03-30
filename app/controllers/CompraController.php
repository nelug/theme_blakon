<?php

class CompraController extends \BaseController {

	public function create()
	{
		if (Input::has('_token'))
		{
			$compra = new Compra;

			if (!$compra->create_master())
			{
				return $compra->errors();
			}

			$id = DB::getPdo()->lastInsertId();

			return Response::json(array(
				'success' => true, 
				'id'      => $id, 
				'detalle' => View::make('compras.detalle')->render()
				));
		}

		return View::make('compras.create');
	}


	public function detalle()
	{
		if (Input::has('_token'))
		{

			$codigo = DetalleCompra::where('compra_id','=',Input::get("compra_id"))
						->where('producto_id','=',Input::get("producto_id"))->get();

			if($codigo != "[]" && !empty(Input::get("compra_id")) && !empty(Input::get("producto_id")))
			{
				return "El codigo ya ha sido ingresado..";
			}

			$query = new DetalleCompra;

			if (!$query->_create())
			{
				return $query->errors();
			}

			return Response::json(array(
				'success' => true,
				'table'   => $this->table_detail()
				));
		}

		return false;
	}

	public function table_detail()
	{
		$query = DB::table('detalle_compras')
		->select(array('detalle_compras.id as id','compra_id', 'producto_id', 'cantidad', 'precio', DB::raw('CONCAT(productos.descripcion, " ", marcas.nombre) AS descripcion, cantidad * precio AS total') ))
		->where('compra_id', Input::get('compra_id'))
		->join('productos', 'detalle_compras.producto_id', '=', 'productos.id')
		->join('marcas', 'productos.marca_id', '=', 'marcas.id')
		->get();

		$deuda = 0;

		$detalle = '<table>
		<thead>
			<tr>
				<th class="hide">id</th>
				<th width="70">Cantidad</th>
				<th width="580">Descripcion</th>
				<th width="70">Precio</th>
				<th width="70">Totales</th>
				<th width="90"></th>
			</tr>
		</thead>
		<tr> <td colspan="5" rowspan="" headers=""> 
			<div class="table-scroll" width="100%">
				<table width="100%"> <tbody> ';

		foreach ($query as $key => $q)
		{
			$deuda = $deuda + $q->total;        
			$precio = number_format($q->precio,2,'.',',');
			$total = number_format($q->total,2,'.',',');

			$detalle.= '<tr>
			<td class="hide">' . $q->producto_id . '</td>
			<td field="cantidad" cod="' . $q->id . '" class="edit" width="60">' . $q->cantidad . '</td>        
			<td width="580"> ' . $q->descripcion . ' </td>
			<td field="precio" cod="' . $q->id . '" class="edit" width="75">' . $precio . '</td>
			<td width="75">' . $total . '</td>
			<td width="50"><i id="' . $q->id . '" href="admin/compras/delete_inicial" class="fa fa-times pointer btn-link theme-c" onClick="DeleteDetalle(this);"></i></td>
			</tr>'; 
		}

		$deuda2 = $deuda;
		$deuda = number_format($deuda,2,'.',',');
		$detalle.= ' </tbody> </table>  </div></td></tr>
					<tr style="border: solid 1px #C5C5C5">
					<td colspan="3" id="totalcompras" class="td_total_text" style="text-align:center"> Total a cancelar</td>
					<td id="total_compras" class="td_total">' . $deuda . '</td>
					<td class="hide"><input id="saldo_compras" type="text" value="' . $deuda2 . '" /></td>
					<td class="td_tabla" colspan="2" ></td></tr>';
		$detalle.= '</table>';

		return $detalle;
	}

	function delete_inicial()
	{

		$detalle = DetalleCompra::find(Input::get('id'));

		$detalle->delete();

		return 'success';
	}

	public function FinalizarCompra()
	{
		return ProcesarCompra::set(Input::get('compra_id'));
	}

	public function serial()
	{
		$data = explode(",", Input::get('serial'));;

		return View::make('compras.serial', compact('data'));
	}

}
