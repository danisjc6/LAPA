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
class AtlaSteps extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * @Given Eu estou na pagina de gerenciar atlas
    */
    public function euEstouNaPaginaDeGerenciarAtlas()
    {
        $this->amOnPage('/auth/atlas');
    }

   /**
    * @Given Eu clico em editar o atlas :arg1
    */
    public function euClicoEmEditarOAtlas($arg1)
    {
        $this->click('Editar', '//table/tbody/tr/td[text()="'.$arg1.'"]/ancestor::tr/td[1]');
        $this->seeInCurrentUrl('/auth/atla/editar/');
    }

   /**
    * @When Eu clico em editar atlas
    */
    public function euClicoEmEditarAtlas()
    {
        $this->click('Editar');
    }

   /**
     * @When Eu clico em escolher arquivo e escolho :arg1
     */
    public function euClicoEmEscolherArquivoEEscolho($arg1)
    {
        $this->attachFile(['name' => 'anexo'], $arg1);
    }

   /**
    * @Then Eu vejo que o atlas foi atualizado corretamente
    */
    public function euVejoQueOAtlasFoiAtualizadoCorretamente()
    {
        $this->see('Página do atlas atualizada com sucesso!');
    }

   /**
    * @Given Eu clico em deletar o atlas :arg1
    */
    public function euClicoEmDeletarOAtlas($arg1)
    {
        $this->click('Deletar', '//table/tbody/tr/td[text()="'.$arg1.'"]/ancestor::tr/td[1]');
    }

   /**
    * @Then Eu vejo que o atlas foi deletado corretamente
    */
    public function euVejoQueOAtlasFoiDeletadoCorretamente()
    {
        $this->see('Página do atlas deletada com sucesso!');
    }

   /**
     * @When Eu edito o titulo para :arg1
     */
    public function euEditoOTituloPara($arg1)
    {
        $this->fillField(['name' => 'titulo'], $arg1);
    }

    /**
     * @When Eu preencho o campo titulo com :arg1
     */
    public function euPreenchoOCampoTituloCom($arg1)
    {
        $this->fillField(['name' => 'titulo'], $arg1);
    }

    /**
     * @When Eu preencho o campo descricao com :arg1
     */
    public function euPreenchoOCampoDescricaoCom($arg1)
    {
        $this->fillField(['name' => 'descricao'], $arg1);
    }

    /**
    * @Given Eu clico em Publicar agora
    */
    public function euClicoEmPublicarAgora()
    {
        $this->click('Publicar agora');

    }
     /**
     * @Given Eu estou na pagina de adicionar atlas
     */
    public function euEstouNaPaginaDeAdicionarAtlas()
    {
        $this->amOnPage('/auth/atla/adicionar');
    }

   /**
    * @Then Eu vejo que o atlas foi adicionado corretamente
    */
    public function euVejoQueOAtlasFoiAdicionadoCorretamente()
    {
        $this->see('Página do atlas adicionada com sucesso!');
    }


}
