<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSatToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('Sun')->nullable();
            $table->string('Mon')->nullable();
            $table->string('Tu')->nullable();
            $table->string('Wed')->nullable();
            $table->string('Thu')->nullable();
            $table->string('Fri')->nullable();
            $table->string('Sat')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            Schema::dropIfExists('settings');
        });
    }
}
