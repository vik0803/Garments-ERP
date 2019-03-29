<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreyFabricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grey_fabrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content');
            $table->string('material');
            $table->string('quantity');
            $table->float('width', 8,4);
            $table->string('weight');
            $table->string('finish')->nullable();
            $table->string('transparency')->nullable();
            $table->string('fire_rating')->nullable();
            $table->text('use');
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
        Schema::dropIfExists('grey_fabrics');
    }
}
