<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('submission_id');
            $table->string('ip', 45)->nullable();
            /*
             * Locale
             */
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->string('country_code', 3)->nullable();
            $table->string('region_name', 50)->nullable();
            $table->decimal('latitude', '8', '6')->nullable();
            $table->decimal('longitude', '8', '6')->nullable();

            /*
             * Weather
             */
            $table->string('weather')->nullable();
            $table->decimal('temperature', '4', '2')->nullable();
            $table->decimal('wind_speed', '4', '2')->nullable();
            $table->integer('pressure')->nullable();
            $table->integer('humidity')->nullable();


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
        Schema::dropIfExists('submission_details');
    }
}
