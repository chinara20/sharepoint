<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskForwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpdesk_forwards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('helpdesk_id');
            $table->integer('user_id');
            $table->integer('forwarded_from')->nullable();
            $table->integer('forward_to')->nullable();
            $table->timestamp('forwarded_at')->nullable();
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('helpdesk_forwards');
    }
}
