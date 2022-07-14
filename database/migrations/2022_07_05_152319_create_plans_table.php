<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('discount')->nullable();
            $table->tinyInteger('messages')->default(0);
            $table->tinyInteger('view_contacts')->default(0);
            $table->tinyInteger('standout_profile')->default(0);
            $table->integer('valid_til')->default(0);
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
        Schema::dropIfExists('plans');
    }
}
