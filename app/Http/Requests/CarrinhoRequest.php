<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarrinhoRequest extends FormRequest
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
            'id_user' => 'required|numeric',
            'produto_id' => 'required|numeric',
            'nome' => 'required',
            'quantidade' => 'required|numeric',
            'data' => 'required',            
            'valor_unitario' => 'required|numeric',
            'status' => 'required'
        ];
    }
}
