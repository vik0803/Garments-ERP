<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDyeChemicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dye_chemicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('color');
            $table->string('classification');
            $table->string('dyes');
            $table->float('concentration', 8,4);
            $table->string('bulk_density');
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
        Schema::dropIfExists('dye_chemicals');
    }
}
