<?php

class InventarioController extends BaseController {

    public function inventario_dt()
    {
        return View::make('producto.inventario_dt');
    }

    public function md_search()
    {
    	return View::make('producto.md-search');
    }

}
