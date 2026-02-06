<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Categoria;

class CategoriaTest extends TestCase
{
   use RefreshDatabase;


    /** @test Adicionar uma categoria valida*/
    public function adicionarUmaCategoriaValida()
    {
        factory(Categoria::class)->create([
            'nome' => 'Categoria Teste',
        ]);
        $this->assertDatabaseHas('categorias', [
            'nome' => 'Categoria Teste',
        ]);
    }

    /** @test Deletar uma Categoria*/
    public function deletarUmaCategoria()
    {
        $categoria = factory(Categoria::class)->create([
            'nome' => 'Categoria Teste',
        ]);
        $categoria->delete();
        $this->assertModelMissing($categoria);
    }

    /**
     * @test atualizar categoria valida
     *
     * @return void
     */
    public function testAtualizarCategoriaValida()
    {
      $categoria = factory(Categoria::class)->create([
          'nome'=>'Categoria para teste',
          ]);
      $this->assertDatabaseHas('categorias', [
        'nome' => 'Categoria para teste',]);
      $categoria->update(['nome'=>'Categoria Atualizada para teste',]);
      $this->assertEquals('Categoria Atualizada para teste',$categoria->nome);

    }

    /**
     * @test Ler categoria nao cadastrada
     *
     * @return void
     */
    public function testLerCategoriaNaoCadastrada()
    {
      $this->assertDatabaseMissing('categorias', [
        'nome' => 'Categoria nao cadastrada teste',]);


    }

}
