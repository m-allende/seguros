<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_vehicle_id');
            $table->string("name");
            $table->string("abbreviation", 20);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('branch_vehicle_id')->references('id')->on('branch_vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_vehicles');
    }
};
