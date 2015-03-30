<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePromocionCliente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promocion_cliente', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('precio_venta_id')->unsigned();
			$table->integer('tipo_cliente_id')->unsigned();
			$table->decimal('porcentaje', 8, 2);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promocion_cliente');
	}

}
