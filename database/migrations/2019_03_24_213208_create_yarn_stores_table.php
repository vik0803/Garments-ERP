<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarnStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarn_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('color');
            $table->string('fiber_content');
            $table->string('weight');
            $table->string('yardageORball');
            $table->string('gauge');
            $table->string('care');
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
        Schema::dropIfExists('yarn_stores');
    }
}
