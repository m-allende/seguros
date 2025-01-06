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
        Schema::table('users', function (Blueprint $table) {
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("website")->nullable();
            $table->date("birthday")->nullable();

            $table->string("address_laboral")->nullable();
            $table->string("phone_laboral_1")->nullable();
            $table->string("phone_laboral_2")->nullable();
            $table->string("email_laboral_1")->nullable();
            $table->string("email_laboral_2")->nullable();

            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('commune_id')->nullable();

            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('commune_id')->references('id')->on('communes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['commune_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['region_id']);

            $table->dropColumn(['commune_id']);
            $table->dropColumn(['city_id']);
            $table->dropColumn(['region_id']);

            $table->dropColumn(['first_name']);
            $table->dropColumn(['last_name']);
            $table->dropColumn(['address']);
            $table->dropColumn(['phone']);
            $table->dropColumn(['website']);
            $table->dropColumn(['address_laboral']);
            $table->dropColumn(['phone_laboral_1']);
            $table->dropColumn(['phone_laboral_2']);
            $table->dropColumn(['email_laboral_1']);
            $table->dropColumn(['email_laboral_2']);

        });
    }
};
