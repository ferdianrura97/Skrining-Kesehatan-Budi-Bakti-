<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id')->index();
            $table->unsignedBigInteger('menu_id')->index();

            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('menu_id')->references('id')->on('menus');
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
        Schema::dropIfExists('level_menus');
    }
}
