<?php

class Compra extends \BaseModel {

	protected $table = 'compras';
	
	protected $guarded = array('id');

	public function detalle_compra()
    {
        return $this->hasMany('DetalleCompra');    
    }
}
