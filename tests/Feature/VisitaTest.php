<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Visita;
use App\User;

class VisitaTest extends TestCase
{
    use RefreshDatabase;

    /** @test Agendar uma visita*/
    public function agendarUmaVisita()
    {
        $user = factory(User::class)->create([
            'user_type' => 'visitant',
        ]);

        $visita = factory(Visita::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('visitas', [
            'descricao' => $visita->descricao,
        ]);
    }

    /** @test Ver uma visita*/
    public function verUmaVisita()
    {
        $user = factory(User::class)->create();

        $visita = factory(Visita::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('visitas', [
            'descricao' => $visita->descricao,
        ]);
    }

    /** @test Confirmar uma visita*/
    public function confirmarUmaVisita()
    {
        $user = factory(User::class)->create();

        $visita = factory(Visita::class)->create([
            'user_id' => $user->id,
        ]);

        $visita->update([
            'confirmada' => true,
        ]);

        $this->assertEquals(true, $visita->confirmada);

    }

    /** @test Cancelar uma visita*/
    public function deletarUmaVisita()
    {
        $user = factory(User::class)->create();

        $visita = factory(Visita::class)->create([
            'user_id' => $user->id,
        ]);

        $visita->delete();
        $this->assertModelMissing($visita);
    }
}
