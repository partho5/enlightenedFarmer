<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->default("");
            $table->string('upozilla');
            $table->string('nidNo');
            $table->string('phone');
            $table->integer("age");
            $table->string("crop_type");
            $table->string('amount_of_land')->default("");
            $table->string('lat')->default("");
            $table->string('long')->default("");
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
        Schema::dropIfExists('farmers');
    }
}
