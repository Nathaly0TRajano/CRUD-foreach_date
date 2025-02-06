<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemVendaUpdateFormRequest extends FormRequest
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
            'venda_id' => 'numeric',
            'produto_id' => 'numeric',
            'quantidade' => 'numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'=> false,
                'message' => 'Erro de Validação',
                'errors' => $validator->errors()
            ], 422)
        );
    }

    public function messages()
    {
        return [
            'venda_id.numeric' => 'O campo precisa ser preenchido apenas com números',
            'produto_id.numeric' => 'O campo precisa ser preenchido apenas com números',
            'quantidade.numeric' => 'O campo precisa ser preenchido apenas com números'
        ];
    }
}
