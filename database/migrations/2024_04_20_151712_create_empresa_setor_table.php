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
        Schema::create('empresa_setor', function (Blueprint $table) {

            $table->primary(['empresa_id', 'setor_id']);

            // Chaves estrangeiras
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('setor_id');

            // Restrições das chaves estrangeiras
            $table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('cascade');
            $table->foreign('setor_id')->references('id')->on('setor')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_setor');
    }
};
