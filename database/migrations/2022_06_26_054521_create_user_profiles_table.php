<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->nullanle();
            $table->unsignedBigInteger('city_id')->nullanle();
            $table->unsignedBigInteger('religion_id')->nullanle();
            $table->unsignedBigInteger('sector_id')->nullanle();
            $table->unsignedBigInteger('cast_id')->nullanle();
            $table->unsignedBigInteger('country_id')->nullanle();

            $table->string('first_name')->nullanle();
            $table->string('last_name')->nullanle();
            $table->string('gender')->nullanle();
            $table->string('age')->nullanle();
            $table->string('date_of_Birth')->nullanle();
            $table->string('marital_status')->nullanle();
            $table->string('height')->nullanle();
            $table->string('On_behalf')->nullanle();
            $table->string('star')->nullanle();
            $table->string('disability')->nullanle();
            $table->string('blood_group')->nullanle();
            $table->string('current_residency_country')->nullanle();
            $table->string('state_of_residency')->nullanle();
            $table->string('city')->nullanle();
            $table->string('town')->nullanle();
            $table->bigInteger('number')->nullanle();
            $table->bigInteger('whatsapp_number')->nullanle();
            $table->string('hobbies')->nullanle();
            $table->string('interest')->nullanle();
            $table->string('qualification')->nullanle();
            $table->string('working_with')->nullanle();
            $table->string('company_name')->nullanle();
            $table->integer('no_of_brothers')->nullanle();
            $table->integer('no_of_sister')->nullanle();
            $table->string('family_type')->nullanle();
            $table->string('father_status')->nullanle();
            $table->string('mother_status')->nullanle();
            $table->string('brother_marital_status')->nullanle();
            $table->string('family_address')->nullanle();
            $table->string('martial_status')->nullanle();
            $table->string('living_with_family')->nullanle();
            $table->bigInteger('annual_income')->nullanle();
            $table->string('about')->nullanle();



            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('cast_id')->references('id')->on('casts')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');            
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
        Schema::dropIfExists('user_profiles');
    }
}
