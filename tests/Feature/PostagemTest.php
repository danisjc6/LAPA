<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Postagem;
use App\Models\User;
use App\Models\Conta;
class PostagemTest extends TestCase
{
     use RefreshDatabase;
    /**
     * Teste criar postagem valida
     *
     * @return void
     */

    public function testCriarPostagemValida()//default é noticia
    {
        $user = factory(User::class)->create(['cpf'=>'999.999.999-99',]);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $postagem = factory(Postagem::class)->create(['titulo'=>'Postagem teste','user_id'=>$user->id,]);
        $this->assertDatabaseHas('postagems', [
        'titulo' =>$postagem->titulo,]);
        $this->assertDatabaseHas('contas', [
        'user_id' =>$user->id,]);

    }
    /**
     * Teste deletar postagem cadastrada
     *
     * @return void
     */
    public function testDeletarPostagemCadastrada()
    {
      $user = factory(User::class)->create(['cpf'=>'999.999.999-99',]);
      factory(Conta::class)->create(['user_id'=>$user->id,]);
      $postagem = factory(Postagem::class)->create(['titulo'=>'Postagem teste para deletar','user_id'=>$user->id,]);
      $this->assertDatabaseHas('contas', [
        'user_id' =>$user->id,]);
      $postagem->delete();
      $this->assertModelMissing($postagem);

    }
    /**
     * Teste atualizar descrição da postagem cadastrada
     *
     * @return void
     */
    public function testEditarPostagemDescricaoValida()
    {
      $user = factory(User::class)->create(['cpf'=>'999.999.999-99',]);
      factory(Conta::class)->create(['user_id'=>$user->id,]);
      $postagem= factory(Postagem::class)->create(['descricao'=>'Essa postagem está sendo criando para teste','user_id'=>$user->id,]);
      $this->assertDatabaseHas('contas', [
        'user_id' =>$user->id,]);
      $this->assertDatabaseHas('postagems', [
        'descricao' => 'Essa postagem está sendo criando para teste',]);
      $postagem->update(['descricao'=>'Essa postagem está sendo atualizada para teste',]);
      $this->assertEquals('Essa postagem está sendo atualizada para teste',$postagem->descricao);

    }
    /**
     * Teste ler postagem nao cadastrada
     *
     * @return void
     */
    public function testLerPostagemNaoCadastrada()
    {
      $this->assertDatabaseMissing('postagems', [
        'descricao' => 'ler postagem não cadastrado',]);
    }
    /**
     * Teste criar postagem do tipo evento valida
     *
     * @return void
     */

    public function testCriarPostagemEventoValida()
    {
        $user = factory(User::class)->create(['cpf'=>'999.999.999-99',]);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $postagem = factory(Postagem::class)->create(['titulo'=>'Postagem teste','user_id'=>$user->id,'tipo_postagem'=>'evento','data'=>'2020-06-26','hora'=>'02:01:00']);
        $this->assertDatabaseHas('postagems',['tipo_postagem'=>'evento',
        'titulo' =>$postagem->titulo,]);
        $this->assertDatabaseHas('contas', [
        'user_id' =>$user->id,]);

    }

    /**
     * Teste criar postagem do tipo edital valida
     *
     * @return void
     */

    public function testCriarPostagemEditalValida()
    {
        $user = factory(User::class)->create(['cpf'=>'999.999.999-99',]);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $postagem = factory(Postagem::class)->create(['titulo'=>'Postagem teste','user_id'=>$user->id,'tipo_postagem'=>'edital']);
        $this->assertDatabaseHas('postagems',['tipo_postagem'=>'edital',
        'titulo' =>$postagem->titulo,]);
        $this->assertDatabaseHas('contas', [
        'user_id' =>$user->id,]);

    }
     /**
     * Teste atualizar postagem do tipo edital com titulo valido
     *
     * @return void
     */

    public function testAtualizarPostagemEditalTituloValido()
    {
        $user = factory(User::class)->create(['cpf'=>'999.999.999-99',]);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $postagem = factory(Postagem::class)->create(['titulo'=>'Postagem teste','user_id'=>$user->id,'tipo_postagem'=>'edital']);
        $this->assertDatabaseHas('postagems',['tipo_postagem'=>'edital',
        'titulo' =>$postagem->titulo,]);
        $this->assertDatabaseHas('contas', [
        'user_id' =>$user->id,]);
	$postagem->update(['titulo'=>'Essa titulo está sendo atualizada para teste',]);
        $this->assertEquals('Essa titulo está sendo atualizada para teste',$postagem->titulo);

    }
}
