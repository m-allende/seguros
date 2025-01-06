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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("address")->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->morphs("parent");
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('commune_id')->nullable();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('commune_id')->references('id')->on('communes');

            $table->softDeletes();
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
        Schema::dropIfExists('addresses');
    }
};
