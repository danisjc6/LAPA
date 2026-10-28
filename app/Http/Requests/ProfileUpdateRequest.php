<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'cpf' => [
                'required',
                'cpf',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'telefone' => [
                'required',
                'string',
                'max:20',
            ],

            'link_lattes' => [
                'nullable',
                'url',
                'max:255',
            ],

            'foto_perfil' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.digits' => 'O CPF deve conter 11 dígitos.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'telefone.required' => 'O telefone é obrigatório.',

            'link_lattes.url' => 'Informe um link Lattes válido.',

            'foto_perfil.image' => 'O arquivo deve ser uma imagem.',
            'foto_perfil.mimes' => 'A foto deve estar nos formatos JPG, JPEG, PNG ou WEBP.',
            'foto_perfil.max' => 'A foto deve ter no máximo 2 MB.',
        ];
    }
}
