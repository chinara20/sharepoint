<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRequirementsTable extends Migration
{
    public function up()
    {
        Schema::create('user_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('requirement_id');
            $table->string('status')->default('pending');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_requirements');
    }
}
