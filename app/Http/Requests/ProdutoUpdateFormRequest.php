<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoUpdateFormRequest extends FormRequest
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
            'nome' => 'min:5|max:50',
            'codigo' => 'unique:App\Models\Produto,codigo|numeric',
            'quantidade_estoque' => 'numeric'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'=> false,
                'message'=> 'Erro de Validação',
                'errors' => $validator->errors()
            ], 422));
    }

    public function messages()
    {
        return [
            'nome.min' => 'O campo precisar ter pelo menos 5 caracteres',
            'nome.max' => 'O campo precisar ter menos de 50 caracteres',
            'codigo.numeric' => 'O campo precisar conter apenas números',
            'codigo.unique' => 'Este código já existe',
            'quantidade_estoque.numeric' => 'O campo precisar conter apenas números'

        ];
    }
}
