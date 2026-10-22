<x-ui.form.section title="Informações do laboratório">
    <x-ui.field name="email" label="E-mail do laboratório" required>
        <x-ui.input name="email" value="{{ old('email', $contato->email ?? '')  }}" placeholder="Ex.: laboratorio@ufape.com"/>
    </x-ui.field>

    <x-ui.field name="texto" label="Descrição - Quem Somos" required>
        <x-ui.textarea name="texto" value="{{ old('texto', $contato->texto ?? '') }}" placeholder="Escreva aqui quem são as pessoas que participam ativamente do laboratorio"/>
    </x-ui.field>

    <x-ui.field name="telefone" label="Telefone para contato do laboratório" required>
        <x-ui.input name="telefone" value="{{ old('telefone',  $contato->telefone ?? '') }}" placeholder="Ex.: (88) 999991111"/>
    </x-ui.field>
</x-ui.form.section>

<x-ui.form.section title="Agendamento de visitas" description="Configure o endereço do formulário externo utilizado para solicitar visitas ao LAPA.">
    <x-ui.field name="link_agendamento_visita" label="Link do formulário" required>
        <x-ui.input name="link_agendamento_visita" value="{{old('link_agendamento_visita', $contato->link_agendamento_visita ?? '') }}"/>
    </x-ui.field>
</x-ui.form.section>

<x-ui.form.section title="Redes sociais">
    <x-ui.field name="instagram" label="Instagram" required>
        <x-ui.input name="instagram" value="{{ old('instagram',  $contato->instagram ?? '') }}" placeholder="Ex.: https://instagram.com/lapaUFAPE"/>
    </x-ui.field>

    <x-ui.field name="twitter" label="Twitter" required>
        <x-ui.input name="twitter" value="{{ old('twitter', $contato->twitter ?? '') }}" placeholder="Ex.: https://twitter.com/lapaUFAPE"/>
    </x-ui.field>

    <x-ui.field name="facebook" label="Facebook" required>
        <x-ui.input name="facebook" value="{{ old('facebook', $contato->facebook ?? '') }}" placeholder="Ex.: https://facebook.com/lapaUFAPE"/>
    </x-ui.field>
</x-ui.form.section>
