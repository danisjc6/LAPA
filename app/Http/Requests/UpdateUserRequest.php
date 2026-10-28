<?php

namespace App\Http\Requests;

use App\Enums\StatusUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $user = $this->route('user');

        return [
            'nome' => [
                'required',
                'string',
                'max:255',
            ],

            'cpf' => [
                'required',
                'cpf',
                Rule::unique('users', 'cpf')->ignore($user->id),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
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

            'remover_foto' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'required',
                Rule::enum(StatusUser::class),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
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

            'status.required' => 'Selecione o status do usuário.',

            'password.min' => 'A nova senha deve possuir pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ];
    }
}
