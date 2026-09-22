@material
Feature: material
  In order to gerenciar o sistema LAPA
  As a cliente
  I need to ser capaz de criar,editar,atualizar,deletar materiais

  Scenario: criar material valido
    Given Eu estou logado como "roberto" com email "roberto@admin.com" e senha "12345678"
    And   Eu estou na pagina de adicionar materiais
    When  Eu preencho o campo titulo com "Material de Ihc"
    And   Eu seleciono o campo escolher origem do anexo link da web
    And   Eu preencho o campo do link da web com "https://drive.google.com/file/d/1eJt5xYMq3chZL92_vbHSDq5VmMO22V80/view?usp=sharing"
    And   Eu clico em Publicar agora
    Then  Eu vejo que o material foi adicionado corretamente

  Scenario: criar material sem nome
    Given Eu estou logado como "roberto" com email "roberto@admin.com" e senha "12345678"
    And   Eu estou na pagina de adicionar materiais
    When  Eu preencho o campo titulo com ""
    And   Eu seleciono o campo escolher origem do anexo link da web
    And   Eu preencho o campo do link da web com "https://drive.google.com/file/d/1eJt5xYMq3chZL92_vbHSDq5VmMO22V80/view?usp=sharing"
    And   Eu clico em Publicar agora
    Then  Eu vejo a mensagem de erro "Título do material é obrigatório"

  Scenario: criar material com nome muito curto
    Given Eu estou logado como "roberto" com email "roberto@admin.com" e senha "12345678"
    And   Eu estou na pagina de adicionar materiais
    When  Eu preencho o campo titulo com "Ma"
    And   Eu seleciono o campo escolher origem do anexo link da web
    And   Eu preencho o campo do link da web com "https://drive.google.com/file/d/1eJt5xYMq3chZL92_vbHSDq5VmMO22V80/view?usp=sharing"
    And   Eu clico em Publicar agora
    Then  Eu vejo a mensagem de erro "Título deve conter no mínimo três letras"

  Scenario: criar material sem texto
    Given Eu estou logado como "roberto" com email "roberto@admin.com" e senha "12345678"
    And   Eu estou na pagina de adicionar materiais
    When  Eu preencho o campo titulo com "Material 1"
    And   Eu preencho o campo texto com ""
    And   Eu seleciono o campo escolher origem do anexo link da web
    And   Eu preencho o campo do link da web com "https://drive.google.com/file/d/1eJt5xYMq3chZL92_vbHSDq5VmMO22V80/view?usp=sharing"
    And   Eu clico em Publicar agora
    Then  Eu vejo a mensagem de erro "Escrever sobre o texto é obrigatório"

  Scenario: criar material sem anexo
    Given Eu estou logado como "roberto" com email "roberto@admin.com" e senha "12345678"
    And   Eu estou na pagina de adicionar materiais
    When  Eu preencho o campo titulo com "Material 1"
    And   Eu preencho o campo texto com ""
    And   Eu clico em Publicar agora
    Then  Eu vejo a mensagem de erro "O campo tipo anexo é obrigatório."

    Given Eu estou logado como "damiao" com email "damiao@admin.com" e senha "12345678"
    And   Eu estou na pagina de adicionar materiais
    When  Eu preencho o campo titulo com "Material 1"
    And   Eu preencho o campo texto com "Descricao do material 1 escrita"
    And   Eu seleciono o campo escolher origem do anexo link da web
    And   Eu preencho o campo do link da web com "https://drive.google.com/file/d/1eJt5xYMq3chZL92_vbHSDq5VmMO22V80/view?usp=sharing"
    And   Eu clico em Publicar agora
    Then  Eu vejo a mensagem de erro "Escolher assunto é obrigátorio"

  Scenario: atualizar material com titulo em branco
    Given Eu estou logado como "damiao" com email "damiao@admin.com" e senha "12345678"
    And   O material "Material de Ihc" ja exista
    And   Eu estou na pagina de gerenciar materiais
    And   Eu clico em editar material com titulo "Material de Ihc"
    When  Eu edito o campo titulo para " "
    And   Eu clico em Publicar agora
    Then  Eu vejo erro ao adicionar material em branco

  Scenario: atualizar material com titulo muito curto
    Given Eu estou logado como "carlos" com email "carlos@admin.com" e senha "12345678"
    And   O material "Material de Ihc" ja exista
    And   Eu estou na pagina de gerenciar materiais
    And   Eu clico em editar material com titulo "Material de Ihc"
    When  Eu edito o campo titulo para "Ih"
    And   Eu clico em Publicar agora
    Then  Eu vejo a mensagem de erro "Título deve conter no mínimo três letras"

  Scenario: atualizar material sem texto
    Given Eu estou logado como "carlos" com email "carlos@admin.com" e senha "12345678"
    And   O material "Material de Ihc" ja exista
    And   Eu estou na pagina de gerenciar materiais
    And   Eu clico em editar material com titulo "Material de Ihc"
    When  Eu edito o campo titulo para "Material de ihc atualizado"
    And   Eu edito o campo texto para ""
    And   Eu clico em Publicar agora
    Then  Eu vejo a mensagem de erro "Escrever sobre o texto é obrigatório"

 Scenario: deletar material valido
    Given Eu estou logado como "carlos" com email "carlos@admin.com" e senha "12345678"
    And   O material "Material de Ihc" ja exista
    And   Eu estou na pagina de gerenciar materiais
    When  Eu clico em deletar material com titulo "Material de Ihc"
    Then  Eu vejo que o material foi deletado corretamente
