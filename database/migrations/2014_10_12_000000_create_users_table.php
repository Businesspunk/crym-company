<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('city', 255)->nullable();
            $table->string('number', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->timestamps();
        });

        Schema::table('profiles', function (Blueprint $table) { 
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
        
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('main_photo');
            $table->integer('isVip')->nullable();
            $table->bigInteger('cost')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->string('youtube')->nullable();
            $table->string('coord_x')->nullable();
            $table->string('coord_y')->nullable();
            $table->integer('promotion_id')->default(1)->unsigned();
            $table->integer('isClose')->nullable();
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) { 
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::table('posts', function (Blueprint $table) { 
            $table->foreign('promotion_id')
                ->references('id')->on('promotions')
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('posts');
    }
}
