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
        Schema::create('conteudo_estrutura', function (Blueprint $table) {
            $table->id();

            $table->foreignId('conteudo_id')
                ->constrained('conteudos')
                ->cascadeOnDelete();

            $table->foreignId('estrutura_id')
                ->constrained('estruturas')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conteudo_estrutura');
    }
};
