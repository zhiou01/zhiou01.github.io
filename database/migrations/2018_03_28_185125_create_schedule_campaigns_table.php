<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('campName');
            $table->string('campId');
            $table->string('userId');
            $table->string('pageId');
            $table->string('time');
            $table->string('status');
            $table->string('content');
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
        Schema::drop('schedule_campaigns');
    }
}
