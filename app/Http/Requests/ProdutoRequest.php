<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'preco' => 'required|numeric',
            'variacoes' => 'required',
            'estoque' => 'required'
        ];
    }

    public function messages()
    {
        return [           
            'nome.required'  => 'O campo nome não pode ficar em branco',
            'preço.required'  => 'O campo preço não pode ficar em branco',
            'variacoes.required'  => 'O campo variações não pode ficar em branco',
            'estoque.required'  => 'É preciso enviar o estoque',
        ];
    }
}
