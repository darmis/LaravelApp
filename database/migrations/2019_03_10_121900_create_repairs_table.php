<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('klientas');
            $table->integer('meistro_id');
            $table->integer('registrator_id')->default(0);
            $table->string('barkodas')->default('-');
            $table->string('mob_tel')->nullable();
            $table->string('tel')->nullable();
            $table->string('busena');
            $table->string('tipas');
            $table->float('daliu_kaina', 8, 2)->nullable();
            $table->float('remonto_kaina', 8, 2)->nullable();
            $table->longText('spec_komp');
            $table->longText('gedimai');
            $table->longText('pastabos')->nullable();
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
        Schema::dropIfExists('repairs');
    }
}
