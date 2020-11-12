<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromoUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->default('VIP продвижение');
            $table->tinyInteger('type_own');

            $table->integer('cost');
            $table->boolean('isRealty')->default(false);

            $table->string('icon')->nullable();
            $table->integer('days')->nullable();
            $table->string('desc')->nullable();

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
        //
    }
}
