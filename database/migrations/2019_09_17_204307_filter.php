<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Filter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('attribute_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attribute_id')->unsigned();
            $table->string('name');
            $table->string('slug');
        });

        Schema::table('attribute_value', function (Blueprint $table) {
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')
                ->onDelete('cascade');
        });

        Schema::create('maincategory_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('maincategory_id')->unsigned();
            $table->bigInteger('attribute_id')->unsigned();
        });

        Schema::table('maincategory_attributes', function (Blueprint $table) {
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')
                ->onDelete('cascade');
            
            $table->foreign('maincategory_id')
                ->references('id')->on('maincategories')
                ->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_value');

    }
}
