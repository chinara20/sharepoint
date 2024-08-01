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
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('requirement_id')->references('id')->on('requirements')->onDelete('cascade');
        });
        // $table->unsignedBigInteger('user_id');
        // $table->unsignedBigInteger('requirement_id');
        // $table->boolean('completed')->default(false);
        // $table->timestamps();
        
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // $table->foreign('requirement_id')->references('id')->on('requirements')->onDelete('cascade');


    }

    public function down()
    {
        Schema::dropIfExists('user_requirements');
    }
}
