<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentlyViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recently_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('viewer_id');
            $table->unsignedInteger('viewed_id');

            $table->foreign('viewer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('viewed_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('recently_views');
    }
}
