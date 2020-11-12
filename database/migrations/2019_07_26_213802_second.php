<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Second extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maincategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('maincategory_id')->unsigned();
            $table->string('name');
            $table->string('fullname')->default(2);
            $table->string('slug');
        });

        Schema::table('categories', function (Blueprint $table) { 
            $table->foreign('maincategory_id')
                ->references('id')->on('maincategories')
                ->onDelete('cascade');
        });

        Schema::table('posts', function (Blueprint $table) { 
            $table->foreign('category_id')
                ->references('id')->on('categories')
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('maincategories');

    }
}
