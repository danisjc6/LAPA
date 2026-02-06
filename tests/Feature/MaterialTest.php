<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Material;
class MaterialTest extends TestCase
{
   use RefreshDatabase;

    /**
     * Teste criar material valido
     *
     * @return void
     */
    public function testCriarMaterialValido()
    {
        $material = factory(Material::class)->create(['titulo'=>'Material teste',]);
        $this->assertDatabaseHas('materials', [
        'titulo' => 'Material teste',]);

    }
    /**
     * Teste deletar material cadastrado
     *
     * @return void
     */
    public function testDeletarMaterialCadastrado()
    {
      $material = factory(Material::class)->create(['titulo'=>'Material teste para deletar',]);
      $material->delete();
      $this->assertModelMissing($material);

    }
    /**
     * Teste atualizar texto do material cadastrado
     *
     * @return void
     */
    public function testEditarMaterialTextoValido()
    {
      $material = factory(Material::class)->create(['texto'=>'Esse material está sendo criando para teste',]);
      $this->assertDatabaseHas('materials', [
        'texto' => 'Esse material está sendo criando para teste',]);
      $material->update(['texto'=>'Esse material está sendo atualizado para teste',]);
      $this->assertEquals('Esse material está sendo atualizado para teste',$material->texto);

    }
    /**
     * Teste ler material nao cadastrado
     *
     * @return void
     */
    public function testLerMaterialNaoCadastrado()
    {
      $this->assertDatabaseMissing('materials', [
        'titulo' => 'ler material não cadastrado',]);


    }
}
