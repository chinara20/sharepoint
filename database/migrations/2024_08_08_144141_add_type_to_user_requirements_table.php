<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToUserRequirementsTable extends Migration
{
    public function up()
    {
        Schema::table('user_requirements', function (Blueprint $table) {
            $table->string('type')->default('entry'); 
        });
    }

    public function down()
    {
        Schema::table('user_requirements', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
