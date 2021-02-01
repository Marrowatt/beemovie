<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FlowersMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowers_months', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('flower_id');
            $table->foreign('flower_id')->references('id')->on('flowers');

            $table->unsignedBigInteger('month_id');
            $table->foreign('month_id')->references('id')->on('months');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flowers_months');
    }
}
