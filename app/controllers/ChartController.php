<?php

class ChartController extends \BaseController {

	public function gastos()
	{
        $dt = App::make('Fecha');

        for ($i=0; $i<=12; $i++)
        {
			$gastos = DB::table('gastos')
	        ->join('detalle_gastos', 'gastos.id', '=', 'detalle_gastos.gasto_id')
	        ->where('tienda_id', 1)
	        ->where(DB::raw('MONTH(gastos.created_at)'), '=', $dt->monthNum($i) )
	        ->where(DB::raw('YEAR(gastos.created_at)'), '=', $dt->year($i) )
	        ->select(DB::raw('sum(monto) as total'))
	        ->first();

	        $g = $gastos->total;
        }

        return View::make('chart.gastos', compact('dt', 'g'));
	}


	public function soporte()
	{
		$g = [];

        $dt = App::make('Fecha');

        for ($i=0; $i<=12; $i++)
        {
			$soporte = DB::table('soporte')
	        ->join('detalle_soporte', 'soporte.id', '=', 'detalle_soporte.soporte_id')
	        ->where('tienda_id', 1)
	        ->where(DB::raw('MONTH(soporte.created_at)'), '=', $dt->monthNum($i) )
	        ->where(DB::raw('YEAR(soporte.created_at)'), '=', $dt->year($i) )
	        ->select(DB::raw('sum(monto) as total'))
	        ->first();

	        $g[] = $soporte->total;
        }

        return View::make('chart.soporte', compact('dt', 'g'));
	}


	public function ventas()
	{
        $dt = App::make('Fecha');

        for ($i=0; $i<=12; $i++)
        {
			$soporte = DB::table('soporte')
	        ->join('detalle_soporte', 'soporte.id', '=', 'detalle_soporte.soporte_id')
	        ->where('tienda_id', 1)
	        ->where(DB::raw('MONTH(soporte.created_at)'), '=', $dt->monthNum($i) )
	        ->where(DB::raw('YEAR(soporte.created_at)'), '=', $dt->year($i) )
	        ->select(DB::raw('sum(monto) as total'))
	        ->first();

			$gastos = DB::table('gastos')
	        ->join('detalle_gastos', 'gastos.id', '=', 'detalle_gastos.gasto_id')
	        ->where('tienda_id', 1)
	        ->where(DB::raw('MONTH(gastos.created_at)'), '=', $dt->monthNum($i) )
	        ->where(DB::raw('YEAR(gastos.created_at)'), '=', $dt->year($i) )
	        ->select(DB::raw('sum(monto) as total'))
	        ->first();

			$ventas = DB::table('ventas')
	        ->join('detalle_ventas', 'ventas.id', '=', 'detalle_ventas.venta_id')
	        ->where('tienda_id', 1)
	        ->where(DB::raw('MONTH(ventas.created_at)'), '=', $dt->monthNum($i) )
	        ->where(DB::raw('YEAR(ventas.created_at)'), '=', $dt->year($i) )
	        ->select(DB::raw('sum(cantidad * precio) as total, sum(cantidad * ganancias ) as ganancias'))
	        ->first();

	        $v = $ventas->total;
	        $g = $ventas->ganancias + $soporte->total - $gastos->total;
        }

        return View::make('chart.ventas', compact('dt', 'v', 'g'));
	}
}
