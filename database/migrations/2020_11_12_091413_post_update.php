<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->bigInteger('follovers')->unsigned()->default(0);

            $table->dropColumn('city');
            $table->bigInteger('city_id')->unsigned()->nullable();
        });

        Schema::table('posts', function (Blueprint $table) { 
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('set null');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
