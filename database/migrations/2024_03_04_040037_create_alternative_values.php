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
        Schema::create('alternative_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('alternative_id');
            $table->foreign('alternative_id')->references('id')->on('alternatives')->onDelete('cascade');
            $table->unsignedBigInteger('criteria_id');
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('cascade');
            $table->string('value')->default('');
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
        Schema::dropIfExists('alternative_values');
    }
};
