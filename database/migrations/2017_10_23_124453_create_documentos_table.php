<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('numero');
            $table->integer('ano');
            $table->date('data_doc');
            $table->text('assunto');
            $table->integer('prioridade')->unsigned();
            $table->string('path_doc')->nullable();
            $table->integer('id_tipo_doc')->unsigned();
            $table->foreign('id_tipo_doc')->references('id')->on('tipo_documentos');
            $table->char('int_ext',1);
            $table->integer('id_departamento')->nullable()->unsigned();
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->integer('id_secretaria')->nullable()->unsigned();
            $table->foreign('id_secretaria')->references('id')->on('secretarias');
            $table->char('status',1)->default('P');
            $table->boolean('arquivado')->default(false);
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
		Schema::drop('documentos');
	}

}
