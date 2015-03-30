<?php

class ProductoController extends Controller {

	public function create()
    {
    	if (Input::has('_token'))
        {
            $producto = new Producto;

            if ($producto->_create())
            {
                return 'success';
            }
            else
            {
                return $producto->errors();
            }
    	}

        return View::make('producto.create');
    }


    public function edit()
    {
    	if (Input::has('_token'))
        {
	    	$producto = Producto::find(Input::get('id'));

			if ( $producto->_update() )
			{
		        return 'success';
			}
			else
			{
			    return $producto->errors();
			}
    	}
    	
        $producto = Producto::find(Input::get('id'));

        $message = "Producto actualizado";

        return View::make('producto.edit', compact('producto', 'message','inactivo'));
    }


    public function delete()
    {
    	$delete = Producto::destroy(Input::get('id'));

    	if ($delete)
    	{
    		return 'success';
    	}

    	return 'error';
    }

    public function find()
    {
        $query = Producto::where('codigo', '=',Input::get('codigo'))->get();

        foreach ($query as $key => $q) 
        {
            return array(
                'success'     => true,
                'descripcion' => $q->descripcion,
                'p_costo'     => 'Precio Costo: '.$q->p_costo,
                'p_publico'   => 'Precio Publico: '.$q->p_publico,
                'existencia'  => 'Existencia: '.$q->existencia,
                'id'          =>  $q->id
            );
        }
        
        return array('success' => false);
      
    }

    public function user_inventario()
    {
        return View::make("producto.user_inventario");       
    }
}
