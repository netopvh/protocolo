<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramitacaosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tramitacaos', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamp('data_tram');
            $table->integer('id_documento')->unsigned();
            $table->foreign('id_documento')->references('id')->on('documentos');
            $table->integer('id_origem')->unsigned();
            $table->integer('id_destino')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->char('tipo_tram',1);
            $table->longText('despacho')->nullable();
            $table->char('status',1);
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
		Schema::drop('tramitacaos');
	}

}
