<?php

class Fecha {

	public function month($v)
	{
		$dt = Carbon::now();
		$m = $dt->month;

		for($i=0; $i<=12; $i++)
		{
		    if($m <= 0)
		    {
		        $m = 12;
		    }
		    $months[] = $m;
	        $meses = $months[$i];

	        $mesArray = array( 
	            1  => "Enero",
	            2  => "Febrero",
	            3  => "Marzo",
	            4  => "Abril", 
	            5  => "Mayo",
	            6  => "Junio", 
	            7  => "Julio", 
	            8  => "Agosto",
	            9  => "Septiembre", 
	            10 => "Octubre", 
	            11 => "Noviembre", 
	            12 => "Diciembre" 
	        );

	        $mesReturn = $mesArray[$meses];  
	        $month[] = $mesReturn;
	        $m--;
		}

	    return $month[$v];
	}


	public function monthNum($v)
	{
		$dt = Carbon::now();
		$m = $dt->month;

		for($i=0; $i<=12; $i++)
		{
		    if($m <= 0)
		    {
		        $m = 12;
		    }

		    $monthNum[] = $m;
		    $m--;
		}

	    return $monthNum[$v];
	}


	public function year($v)
	{
		$dt = Carbon::now();
		$m = $dt->month;
		$y = $dt->year;

		for($i=0; $i<=12; $i++)
		{
		    if($m <= 0)
		    {
		        $y--;
		        $m = 12;
		    }

		    $year[] = $y;
		    $m--;
		}

	    return $year[$v];
	}

}