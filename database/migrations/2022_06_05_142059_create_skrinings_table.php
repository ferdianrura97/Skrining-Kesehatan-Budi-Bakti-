<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkriningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skrinings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('staff_id')->nullable()->constrained('staff');
            $table->foreignId('siswa_id')->nullable()->constrained('siswas');
            $table->datetime('tgl_pengisian');
            $table->enum('status_kesehatan_keluarga',['sehat','pandemi']);
            $table->enum('status',['sehat','sakit','karantina','positif']);
            $table->enum('masuk_sekolah',['0','1']);
            $table->string('swab_file')->nullable();
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
        Schema::dropIfExists('skrinings');
    }
}
