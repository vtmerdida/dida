<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driverPhone')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('idNum');
            $table->string('bankCard');
            $table->text('head');
            $table->string('motoNum');
            $table->string('motoType');
            $table->string('license');
            $table->text('idFrontPhoto');
            $table->text('idBehindPhoto');
            $table->text('motoFrontPhoto');
            $table->text('motoSidePhoto');
            $table->string('isPass');
            $table->datetime('regTime');
            $table->string('orderFnishedNum');
            $table->string('stars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('drivers');
    }
}
