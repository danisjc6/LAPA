<?php

namespace Tests\Feature;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Conta;
class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste criar usuário administrador valido
     *
     * @return void
     */
    public function testCriarUsuarioValido()
    {
        $user = factory(User::class)->create(['cpf'=>'999.999.999-99',]);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $this->assertDatabaseHas('users', [
        'cpf' => '999.999.999-99',]);
        $this->assertDatabaseHas('contas', [
       'user_id' => $user->id,]);

    }

     /**
     * Teste deletar usuário administrador cadastrado
     *
     * @return void
     */
    public function testDeletarUsuarioCadastrado()
    {
      $user= factory(User::class)->create(['cpf'=>'888.888.888-88',]);
      factory(Conta::class)->create(['user_id'=>$user->id,]);
      $this->assertDatabaseHas('contas', [
       'user_id' => $user->id,]);
      $user->delete();
      $this->assertModelMissing($user);

    }
    /**
     * Teste atualizar nome valido de usuário administrador cadastrado
     *
     * @return void
     */
    public function testEditarUsuarioNomeValido()
    {
      $user= factory(User::class)->create(['name'=>'Cecilia',]);
      factory(Conta::class)->create(['user_id'=>$user->id,]);
      $this->assertDatabaseHas('contas', [
       'user_id' => $user->id,]);
      $this->assertDatabaseHas('users', [
        'name' => 'Cecilia',]);
      $user->update(['name'=>'Taylor',]);
      $this->assertEquals('Taylor',$user->name);

    }
     /**
     * Teste ler usuario nao cadastrado
     *
     * @return void
     */
    public function testLerUsuarioNaoCadastrado()
    {
      $this->assertDatabaseMissing('users', [
        'cpf' => '000.000.000-00',]);


    }
    /**
     * Teste criar usuário administrador valido com link lattes
     *
     * @return void
     */
    public function testCriarUsuarioValidoComLinkLattes()
    {
        $user = factory(User::class)->create(['cpf'=>'999.999.999-99','link_lattes'=>'http://lattes.cnpq.br/3151296501932443']);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $this->assertDatabaseHas('users', [
        'cpf' => '999.999.999-99',]);
        $this->assertDatabaseHas('contas', [
       'user_id' => $user->id,]);

    }
    /**
     * Teste criar usuário administrador valido com foto de perfil
     *
     * @return void
     */
    public function testCriarUsuarioValidoComFotoPerfil()
    {
        $user =factory(User::class)->create(['cpf'=>'999.999.999-99','avatar'=>'public/img/avatares/imag1']);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $this->assertDatabaseHas('users', [
        'cpf' => '999.999.999-99',]);
        $this->assertDatabaseHas('contas', [
       'user_id' => $user->id,]);

    }
     /**
     * Teste criar usuário administrador valido ser descrição
     *
     * @return void
     */
    public function testCriarUsuarioValidoSemDescricao()
    {
        $user =factory(User::class)->create(['cpf'=>'999.999.999-99','user_description'=>null]);
        factory(Conta::class)->create(['user_id'=>$user->id,]);
        $this->assertDatabaseHas('users', [
        'cpf' => '999.999.999-99','user_description'=>null]);
        $this->assertDatabaseHas('contas', [
       'user_id' => $user->id,]);

    }

}
