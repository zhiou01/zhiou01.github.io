<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('pageId');
            $table->string('pageName');
            $table->string('message');
            $table->string('key_word');
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
        Schema::drop('monitor_logs');
    }
}
