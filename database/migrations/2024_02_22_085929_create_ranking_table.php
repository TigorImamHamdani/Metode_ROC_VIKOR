<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('alternative_id');
            $table->string('result_rank')->nullable();
            $table->float('utility_measure')->default(false);
            $table->float('regret_measure')->default(false); 
            $table->float('result_cal')->default(false);
            $table->foreign('alternative_id')->references('id')->on('alternatives')->onDelete('cascade');
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
        Schema::dropIfExists('rankings');
    }
};
