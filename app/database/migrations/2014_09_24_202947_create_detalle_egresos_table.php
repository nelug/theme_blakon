<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleEgresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalle_egresos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('egresos_id')->unsigned();
			$table->timestamps();

			$table->foreign('egresos_id')->references('id')->on('egresos')->onDelete('restrict')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detalle_egresos');
	}

}
