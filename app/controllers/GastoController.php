<?php

class GastoController extends \BaseController {

    public function __construct(Table $table)
    {
        $this->table = $table;
    } 

     public function create()
    {
        if (Input::has('_token'))
        {
            $query = new DellateGasto;

            if ($query->_create())
            {
                $href = 'user/gastos/delete_detail';

                return Response::json(array('success' => true, 'table' => $this->table->detail($query, 'gasto_id', $href )));
            }

            return $query->errors();
        }


        $soporte = new Gasto;

        if (!$soporte->create_master())
        {
            return $soporte->errors();
        }

        $id = DB::getPdo()->lastInsertId();

        $message = 'Gasto ingresado';

        $name = 'gasto_id';

        return View::make('gastos.create', compact('id', 'message', 'name'));

    }

    public function delete_detail()
    {
        $delete = DetalleGasto::destroy(Input::get('id'));

        if ($delete)
        {
            return Response::json(array('success' => true, 'msg' => 'Gasto eliminado' ), 200);
        }

        return Response::json(array('success' => false, 'msg' => 'Huvo un error al tratar de eliminar' ));
    }

}
 