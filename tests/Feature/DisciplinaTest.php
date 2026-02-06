<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Disciplina;

class DisciplinaTest extends TestCase
{

    use RefreshDatabase;

    /** @test Adicionar uma disciplina*/
    public function adicionarUmaDisciplina()
    {
        $disciplina = factory(Disciplina::class)->create([
            'nome' => 'Engenharia de Software',
        ]);
        $this->assertDatabaseHas('disciplinas', [
            'nome' => 'Engenharia de Software',
        ]);
    }

    /** @test Adicionar uma disciplina sem user*/
    public function adicionarUmaDisciplinaSemUser()
    {
        $disciplina = factory(Disciplina::class)->states('no_user')->create([
            'nome' => 'IHC',
        ]);
        $this->assertDatabaseHas('disciplinas', [
            'nome' => 'IHC',
            'user_id' => null,
        ]);
    }

    /** @test Deletar uma disciplina*/
    public function deletarUmaDisciplina()
    {
        $disciplina = factory(Disciplina::class)->create([
            'nome' => 'Engenharia de Software',
        ]);
        $disciplina->delete();
        $this->assertModelMissing($disciplina);
    }

}
