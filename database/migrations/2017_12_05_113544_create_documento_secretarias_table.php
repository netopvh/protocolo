<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoSecretariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_secretarias', function (Blueprint $table) {
            $table->integer('id_documento');
            $table->integer('id_secretaria');

            $table->foreign('id_documento')->references('id')->on('documentos');
            $table->foreign('id_secretaria')->references('id')->on('secretarias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_secretarias');
    }
}
