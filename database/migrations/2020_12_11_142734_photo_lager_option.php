<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhotoLagerOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PostsPhotos', function (Blueprint $table) {
            $table->string('url_lager')->nullable();
            $table->boolean('is_main')->default(false);
        });

        Schema::create('photo_temps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('url_lager');
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
    }
}
