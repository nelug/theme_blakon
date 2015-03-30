<?php

class MetodoPago extends \Eloquent {

	protected $table = 'metodo_pago';

	protected $guarded = array('id');

    public function DetalleSoporte()
    {
        return $this->hasMany('DetalleSoporte', 'detalle_soporte_id');
    }
}
