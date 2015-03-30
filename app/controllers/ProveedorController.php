<?php

class ProveedorController extends BaseController {

    public function search()
    {
        return Autocomplete::get('proveedores', array('id', 'nombre','direccion','direccion'),'direccion');
    }

    public function help()
    {
    	$data = Proveedor::find(Input::get('id'));

    	return View::make('proveedor.help', compact('data'));
    }
    
    public function index()
    {
        return View::make('proveedor.index');
    }

    public function contacto_create()
    {

    }

    public function contacto_update()
    {
        
    }

    public function contactos_list()
    {
        $data = ProveedorContacto::where('proveedor_id','=',Input::get('id'))->get();
        $lista = '<ul>';

        $lista .= '</ul>';
            
    }

}
 