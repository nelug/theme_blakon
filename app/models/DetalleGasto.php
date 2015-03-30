<?php

class DetalleGasto extends \BaseModel {

	protected $table = 'detalle_gastos';

	protected $guarded = array('id');

	public function metodo_pago()
    {
        return $this->belongsTo('MetodoPago');    
    }

}
