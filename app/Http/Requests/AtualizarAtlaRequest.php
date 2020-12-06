<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtualizarAtlaRequest extends FormRequest
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
            'titulo' => 'required|min:5|string|max:255',
            'descricao' => 'required|min:10|string',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'descricao_anexos.*' => 'max:255',
            'anexos.*' => 'image|max:2048',
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
            'titulo.required' => 'O título do atlas é obrigatório.',
            'titulo.min' => 'O tamanho mínimo do título é de 5 letras.',
            'descricao.required' => 'A descrição do atlas é obrigatório.',
            'descricao.min' => 'O tamanho mínimo da descrição é 10 letras.',
            'categoria_id.required' => 'A área de conhecimento é obrigatória.',
            'categoria_id.exists' => 'A área de conhecimento deve estar cadastrada.',
            'descricao_anexos.*.max' => 'O campo de descrição não deve ter mais que 255 letras',
            'anexos.*.image' => 'Os arquivos devem ser dos seguintes tipos: jpeg, png, bmp, gif, svg ou webp.',
        ];
    }
}