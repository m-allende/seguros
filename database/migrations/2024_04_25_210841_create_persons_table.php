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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string("identification")->nullable();
            $table->unsignedBigInteger('type_id');
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mother_last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string("abbreviation", 20)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('profesion')->nullable();
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();

            $table->foreign('type_id')->references('id')->on('codes');
            $table->foreign('marital_status_id')->references('id')->on('codes');
            $table->foreign('gender_id')->references('id')->on('codes');

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
        Schema::dropIfExists('persons');
    }
};
