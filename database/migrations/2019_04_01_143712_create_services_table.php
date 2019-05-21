<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kliento_id')->nullable();
            $table->integer('registrator_id')->nullable();
            $table->integer('meistro_id')->nullable();
            $table->string('klientas')->nullable();
            $table->string('tel')->nullable();
            $table->string('adresas')->nullable();
            $table->string('atstumas')->nullable();
            $table->string('darbo_laikas')->nullable();
            $table->string('dirbta_val')->nullable();
            $table->longtext('uzduotis')->nullable();
            $table->longtext('atlikta')->nullable();
            $table->string('busena')->default('uzregistruotas');
            $table->boolean('arRodo')->default(true);
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
        Schema::dropIfExists('services');
    }
}
