<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerPrefrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_prefrences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('age')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('community')->nullable();
            $table->string('country_living_in')->nullable();
            $table->string('state_living_in')->nullable();
            $table->string('city/district')->nullable();
            $table->string('martial_status')->nullable();
            $table->tinyInteger('photo_visibilaty')->default(0);
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('partner_prefrences');
    }
}
