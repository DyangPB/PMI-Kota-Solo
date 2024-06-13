<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('id_report');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_jeniskejadian');
            $table->date('tanggal_kejadian');
            $table->text('keterangan');
            $table->timestamp('timestamp_report');
            $table->enum('status', ['On_Proses', 'Selesai', 'Belum_Diverifikasi']);
            $table->double('lokasi_longitude')->nullable();
            $table->double('lokasi_latitude')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('id_jeniskejadian')->references('id_jeniskejadian')->on('jenis_kejadian')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
