<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContatoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['nullable', 'email', 'max:255'],
            'texto' => ['nullable', 'string'],
            'telefone' => ['nullable', 'string', 'max:20'],

            'facebook' => ['nullable', 'url:https', 'max:2048'],
            'twitter' => ['nullable', 'url:https', 'max:2048'],
            'instagram' => ['nullable', 'url:https', 'max:2048'],

            'link_agendamento_visita' => ['nullable', 'url:https', 'max:2048',],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.email' => 'Informe um endereço de e-mail válido.',
            'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',

            'facebook.url' => 'Informe um link válido para o Facebook.',
            'twitter.url' => 'Informe um link válido para o Twitter.',
            'instagram.url' => 'Informe um link válido para o Instagram.',

            'link_agendamento_visita.url' => 'Informe um link HTTPS válido para o formulário de agendamento.',
        ];
    }
}
