<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpdesk_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('helpdesk_id');
            $table->integer('user_id');
            $table->integer('forwarded_from')->nullable();
            $table->text('message')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('helpdesk_conversations');
    }
}
