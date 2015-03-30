<?php

class ProcesarCompra 
{	
	public static function set($compra_id, $nota = null,$saldo = 0.00)
	{

		ProcesarCompra::UpdateProducto($compra_id);

		$compra = Compra::find($compra_id);

		$compra->completed = 1 ;

		//$compra->saldo = $saldo;

		$compra->nota = $nota;

		$compra->save();

		return 'success';
	}

	public static function delete($compra_id)
	{
		ProcesarCompra::ResetProducto($compra_id);

		Compra::destroy($compra_id);

		return 'Compra Eliminada...!';
	}

	public static function RecalculatedProductoPrecio($detalle_id , $precio)
	{
		
	}

	public static function RecalculatedProductoCantidad($detalle_id , $cantidad)
	{
		
	}

	public static function UpdateProducto($compra_id)
	{
		$detalle = DetalleCompra::where('compra_id','=',$compra_id)->get();
			
		foreach ($detalle as $key => $dt) 
		{
			$producto = ProcesarCompra::getPrecioProducto($dt->producto_id);

			$precio = ProcesarCompra::getPrecio(($dt->precio*100),$dt->cantidad,$producto[0],$producto[1]);

			ProcesarCompra::setProducto($dt->producto_id , $precio[0] , $precio[1]);
		}
	}

	public static function ResetProducto($compra_id)
	{
		$detalle = DetalleCompra::where('compra_id','=',$compra_id)->get();

		foreach ($detalle as $key => $dt) 
		{
			$producto = ProcesarCompra::getPrecioProducto($dt->producto_id);

			$precio = ProcesarCompra::resetPrecio(($dt->precio*100),$dt->cantidad,$producto[0],$producto[1]);

			ProcesarCompra::setProducto($dt->producto_id , $precio[0] , $precio[1]);
		}
	}

	public static function getPrecio($precio, $cantidad, $_precio, $_cantidad)
	{
		$total_nvo = $precio * $cantidad;

		$total_inv = $_precio * $_cantidad;

		$total = $total_nvo + $total_inv;

		$existencia = $cantidad + $_cantidad ;

		$precio_costo = $total / $existencia;

		return  array( $precio_costo ,  $existencia );
	}

	public static function resetPrecio($precio, $cantidad, $_precio, $_cantidad)
	{
		$total_nvo = $precio * $cantidad;

		$total_inv = $_precio * $_cantidad;

		$total = $total_inv - $total_nvo;

		$existencia = $_cantidad - $cantidad ;

		if ($existencia == 0) 
			$precio_costo = $total;

		else
		$precio_costo = $total / $existencia;
	

		return  array( $precio_costo ,  $existencia );
	}

	public static function getPrecioProducto($producto_id)
	{
		$producto = Producto::find($producto_id);

		return array($producto->p_costo , $producto->existencia);
	}

	public static function setProducto($producto_id, $p_costo, $existencia)
	{
		$producto = Producto::find($producto_id);

		$producto->p_costo = $p_costo;

		$producto->existencia = $existencia;

		$producto->save();
	}

}
