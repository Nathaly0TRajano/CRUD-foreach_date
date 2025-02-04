<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteUpdateFormRequest extends FormRequest
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
            'nome' => 'min:3|max:50',
            'email' => 'email|min:11|max:80|unique:App\Models\Cliente,email',
            'telefone' => 'min:9|max:15',
            'endereco' => 'min:10|max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'=> false,
                'message' => 'Erro de Validação',
                'errors' => $validator->errors()
            ], 422));
    }

    public function messages()
    {
        return [
            'nome.min' => 'O campo precisar ter pelo menos 3 caracteres',
            'nome.max' => 'O campo precisar ter menos de 50 caracteres',
            'email.email' => 'O campo não foi digitado corretamente, necessário person@gmail.com',
            'email.unique' => 'Este email já existe',
            'email.min' => 'O campo necessita de pelo menos 11 caracteres',
            'email.max' => 'O campo precisar ter menos de 80 caracteres',
            'telefone.min' => 'O campo precisar ter pelo menos 9 caracteres',
            'telefone.max' => 'O campo precisar ter menos de 15 caracteres',
            'endereco.min' => 'O campo precisar ter pelo menos 10 caracteres',
            'endereco.max' => ' campo precisar ter menos de 255 caracteres'

        ];
    }

}
