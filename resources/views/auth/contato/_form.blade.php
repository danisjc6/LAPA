<x-ui.form.section title="Informações do laboratório">
    <x-ui.field name="email" label="E-mail do laboratório" required>
        <x-ui.input name="email" value="{{ isset($registro->email) ? $registro->email : old('email') }}" placeholder="Ex.: laboratorio@ufape.com"/>
    </x-ui.field>

    <x-ui.field name="texto" label="Descrição - Quem Somos" required>
        <x-ui.textarea name="texto" value="{{ old('texto', $registro->texto ?? '') }}" placeholder="Escreva aqui quem são as pessoas que participam ativamente do laboratorio"/>
    </x-ui.field>

    <x-ui.field name="telefone" label="Telefone para contato do laboratório" required>
        <x-ui.input name="telefone" value="{{ isset($registro->telefone) ? $registro->telefone : old('telefone') }}" placeholder="Ex.: (88) 999991111"/>
    </x-ui.field>
</x-ui.form.section>

<x-ui.form.section title="Redes sociais">
    <x-ui.field name="instagram" label="Instagram" required>
        <x-ui.input name="instagram" value="{{ isset($registro->instagram) ? $registro->instagram : old('instagram') }}" placeholder="Ex.: https://instagram.com/lapaUFAPE"/>
    </x-ui.field>

    <x-ui.field name="twitter" label="Twitter" required>
        <x-ui.input name="twitter" value="{{ isset($registro->twitter) ? $registro->twitter : old('twitter') }}" placeholder="Ex.: https://twitter.com/lapaUFAPE"/>
    </x-ui.field>

    <x-ui.field name="facebook" label="Facebook" required>
        <x-ui.input name="facebook" value="{{ isset($registro->facebook) ? $registro->facebook : old('facebook') }}" placeholder="Ex.: https://facebook.com/lapaUFAPE"/>
    </x-ui.field>
</x-ui.form.section>
