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

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->unsignedBigInteger('cast_id')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('date_of_Birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('height')->nullable();
            $table->string('On_behalf')->nullable();
            $table->string('star')->nullable();
            $table->string('disability')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('current_residency_country')->nullable();
            
            $table->string('city')->nullable();
            $table->string('town')->nullable();
            $table->bigInteger('number')->nullable();
            $table->bigInteger('whatsapp_number')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('interest')->nullable();
            $table->string('qualification')->nullable();
            $table->string('working_with')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('no_of_brothers')->nullable();
            $table->integer('no_of_sister')->nullable();
            $table->string('family_type')->nullable();
            $table->string('father_status')->nullable();
            $table->string('mother_status')->nullable();
            $table->string('brother_marital_status')->nullable();
            $table->string('family_address')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('living_with_family')->nullable();
            $table->bigInteger('annual_income')->nullable();
            $table->string('about')->nullable();
            $table->unsignedInteger('profile_visited')->default(0);
            $table->unsignedInteger('view_contacts')->default(0);
            $table->string('package_type')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('cast_id')->references('id')->on('casts')->onDelete('cascade');
            // $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');            
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
