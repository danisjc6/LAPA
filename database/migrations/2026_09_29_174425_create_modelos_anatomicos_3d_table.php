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
        Schema::create('modelos_anatomicos_3d', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug');
            $table->text('descricao')->nullable();
            $table->string('arquivo_path');
            $table->string('preview_image_path')->nullable();

            $table->unsignedInteger('ordem')->default(0);
            $table->boolean('ativo')->default(true);

            $table->foreignId('animal_id')->constrained('animais');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos_anatomicos_3d');
    }
};
