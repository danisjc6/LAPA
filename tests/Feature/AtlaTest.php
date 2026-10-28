<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Atla;

class AtlaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste criar pagina de atlas valido
     *
     * @return void
     */
    public function testCriarAtlaValido()
    {
        $atla = factory(Atla::class)->create([
            'titulo' => 'Atla teste',
        ]);

        $this->assertDatabaseHas('atlas', [
            'titulo' => $atla->titulo,
        ]);
    }

    /**
     * Teste deletar pagina de atlas cadastrado
     *
     * @return void
     */
    public function testDeletarAtlaCadastrado()
    {
        $atla = factory(Atla::class)->create([
            'titulo' => 'Atla teste para deletar',
        ]);
        $atla->delete();
        $this->assertModelMissing($atla);
    }

    /**
     * Teste atualizar descricao do pagina de atlas cadastrado
     *
     * @return void
     */
    public function testEditarAtlaTextoValido()
    {
        $atla = factory(Atla::class)->create([
            'descricao' => 'Essa pagina do atlas está sendo criando para teste',
        ]);
        $this->assertDatabaseHas('atlas', [
            'descricao' => $atla->descricao,
        ]);
        $atla->update([
            'descricao' => 'Essa pagina do atlas está sendo atualizado para teste',
        ]);
        $this->assertEquals('Essa pagina do atlas está sendo atualizado para teste', $atla->descricao);
    }

    /**
     * Teste ler a pagina do atlas nao cadastrada
     *
     * @return void
     */
    public function testLerAtlaNaoCadastrado()
    {
        $this->assertDatabaseMissing('atlas', [
            'titulo' => 'ler a pagina do atlas  não cadastrada',
        ]);
    }
}
