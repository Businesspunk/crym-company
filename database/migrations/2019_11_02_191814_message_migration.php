<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('one_side_id')->unsigned();
            $table->bigInteger('other_side_id')->unsigned();
            $table->bigInteger('post_id')->unsigned()->nullable();

            $table->foreign('one_side_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('other_side_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('set null');
            
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message');
            $table->bigInteger('dialog_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('isPhoto')->default(false);
            $table->timestamps();

            $table->foreign('dialog_id')
                ->references('id')->on('dialogs')
                ->onDelete('cascade');
            
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::create('messagesNotification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
