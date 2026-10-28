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
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();

            $table->string('tipo', 50);

            $table->string('titulo')->nullable();

            $table->text('descricao')->nullable();

            $table->text('legenda')->nullable();

            $table->string('path');

            $table->string('thumbnail_path')->nullable();

            $table->string('mime_type', 100)->nullable();

            $table->string('extensao', 20)->nullable();

            $table->unsignedBigInteger('tamanho')->nullable();

            $table->string('alt_text')->nullable();

            $table->boolean('is_cover')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            $table->foreignId('conteudo_id')
                ->nullable()
                ->constrained('conteudos')
                ->nullOnDelete();

            $table->foreignId('secao_id')
                ->nullable()
                ->constrained('secoes')
                ->nullOnDelete();

            $table->foreignId('animal_id')
                ->nullable()
                ->constrained('animais')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique('path');

            $table->index('conteudo_id');
            $table->index('secao_id');
            $table->index('animal_id');
            $table->index('tipo');
            $table->index('is_cover');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
