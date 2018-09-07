<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 30);
            $table->string('phone', 50);
            $table->unsignedInteger('lead_by')->nullable();
            $table->timestamps();
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->foreign('lead_by')->references('id')->on('submissions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
