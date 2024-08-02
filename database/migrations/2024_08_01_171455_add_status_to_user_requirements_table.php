<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToUserRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_requirements', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('requirement_id');
        });
    }

    public function down()
    {
        Schema::table('user_requirements', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
