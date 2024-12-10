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
        Schema::create('foto_upload', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cliente_id')->nullable(); // Adiciona a coluna dono_id
            $table->foreign('cliente_id')->references('id')->nullable()->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fotografo_id')->nullable(); // Adiciona a coluna upload_foto_id
            $table->foreign('fotografo_id')->references('id')->nullable()->on('users')->onDelete('cascade');
            $table->string('foto_caminho')->nullable();
            $table->boolean('aprovacao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_upload');
    }
};
