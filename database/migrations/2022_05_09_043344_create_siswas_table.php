<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('level_id')->constrained();
            $table->foreignId('kelas_id')->constrained();
            $table->string('nama');
            $table->string('tgl_lahir');
            $table->enum('jenis_kelamin',['pria','perempuan']);
            $table->string('no_hp');
            $table->string('nomor_induk')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
