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
        Schema::table('companies', function (Blueprint $table) {
            $table->string("identification")->nullable();
            $table->string("short_name")->nullable();
            $table->string("abbreviation", 20)->nullable();
            $table->string("website")->nullable();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['commune_id']);
            $table->dropColumn(['commune_id']);
            $table->dropColumn(['identification']);
            $table->dropColumn(['short_name']);
            $table->dropColumn(['abbreviation']);
            $table->dropColumn(['website']);
            $table->dropColumn(['type']);
        });
    }
};
