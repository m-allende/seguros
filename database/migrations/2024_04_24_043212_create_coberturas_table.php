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
        Schema::create('coberturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ramo_id');
            $table->string("name");
            $table->string("abbreviation", 20);
            $table->string("code")->nullable();
            $table->boolean('tax');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('expressed_in_id');

            $table->foreign('type_id')->references('id')->on('codes');
            $table->foreign('expressed_in_id')->references('id')->on('codes');
            $table->foreign('ramo_id')->references('id')->on('ramos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coberturas');
    }
};
