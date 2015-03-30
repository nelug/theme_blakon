<?php

class DetalleVenta extends \BaseModel {

	protected $table = 'detalle_ventas';

	protected $guarded = array('id');

	public function producto()
    {
        return $this->belongsTo('Producto', 'producto_id');    
    }

    public function venta()
    {
        return $this->belongsTo('Venta', 'venta_id');    
    }

}
