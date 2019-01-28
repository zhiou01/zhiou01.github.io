<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_senders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('senderId');
            $table->string('name');
            $table->string('conId');
            $table->string('pageId');
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
        Schema::drop('camp_senders');
    }
}
