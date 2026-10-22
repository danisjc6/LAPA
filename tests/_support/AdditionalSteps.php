<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/

use Illuminate\Support\Facades\Hash;

class AdditionalSteps extends \Codeception\Actor
{

    use _generated\AcceptanceTesterActions;

    /**
     * @Given Eu estou logado como :arg1 com email :arg2 e senha :arg3
     */
    public function euEstouLogadoComoComEmailESenha($arg1, $arg2, $arg3)
    {
        $this->haveInDatabase('users', [
            'name' => $arg1,
            'cpf' =>  "123.456.789-10",
            'cpf_verified_at' => now(),
            'email' => $arg2,
            'email_verified_at' => now(),
            'telephone' => "(81)98181-8181",
            'user_type' => 'admin',
        ]);

        $user = $this->grabFromDatabase('users', 'id', array('email' => $arg2));

        $this->haveInDatabase('contas', [
            'password' => '$2y$10$ND9yznr7gDYnYyaEbMtzNuwAWs6oAvX8K/SIguz8teFBSTAbPeyG6',
            'user_id' => $user,
        ]);

        $this->amOnPage('/login');
        $this->fillField(['name' => 'email'], $arg2);
        $this->fillField(['name' => 'password'], $arg3);
        $this->click('Entrar');
        $this->see($arg1, '//a');
    }
    /**
     * @Given o contato :arg1 ja exista
     */
    public function oContatoJaExista($arg1)
    {
        $user = $this->grabFromDatabase('users', 'id', array('email' => $arg1));

        $this->haveInDatabase('contatos', [
                'user_id' => $user,
                'email' => $arg1,
                'texto' => 'teste de uma descricao',
                'telefone' => '88 999999999',
                'instagram' => 'https://instagram.com/exemplo',
                'twitter' => 'https://twitter.com/exemplo',
                'facebook' => 'https://facebook.com/exemplo',
        ]);
    }

     /**
     * @Given O usuario administrador com nome :arg1,email :arg2 e senha :arg3 existe
     */
     public function oUsuarioAdministradorComNomeemailESenhaExiste($arg1, $arg2, $arg3)
     {
         $this->haveInDatabase('users', [
            'name' => $arg1,
            'cpf' =>  "123.456.789-10",
            'cpf_verified_at' => now(),
            'email' => $arg2,
            'email_verified_at' => now(),
            'telephone' => "(81)98181-8181",
            'user_type' => 'admin',
        ]);

        $user = $this->grabFromDatabase('users', 'id', array('email' => $arg2));

        $this->haveInDatabase('contas', [
            'password' => '$2y$10$4fSjqJsdiTwWChNwuxoYteEqPQEaF6Z87YLtX9Jh5UbZT9jtPPMha',
            'user_id' => $user,
        ]);

     }

      /**
    * @When Eu seleciono o campo escolher origem do anexo link do drive
    */
    public function euSelecionoOCampoEscolherOrigemDoAnexoLinkDoDrive()
    {
        $this->selectOption('input[name=tipo_anexo]', 'link_drive');
    }

    /**
    * @When Eu seleciono o campo escolher origem do anexo link da web
    */
    public function euSelecionoOCampoEscolherOrigemDoAnexoLinkDaWeb()
    {
        $this->selectOption('input[name=tipo_anexo]', 'link_web');
    }

    /**
    * @When Eu preencho o campo do link do arquivo com :arg1
    */
    public function euPreenchoOCampoDoLinkDoArquivoCom($arg1)
    {
        $this->fillField(['name' => 'anexo_drive'], $arg1);
    }

     /**
    * @When Eu preencho o campo do link da web com :arg1
    */
    public function euPreenchoOCampoDoLinkDaWebCom($arg1)
    {
        $this->fillField(['name' => 'anexo_web'], $arg1);
    }
      /**
    * @When Eu seleciono o campo escolher origem do avatar link do drive
    */
    public function euSelecionoOCampoEscolherOrigemDoAvatarLinkDoDrive()
    {
        $this->selectOption('input[name=tipo_avatar]', 'link_drive');
    }

}
