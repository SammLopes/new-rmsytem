<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteWithContatosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cnpj' => 'nullable|unique:clientes|cnpj',
            'cpf' => 'nullable|unique:clientes|cpf',
            'nome' => 'required_if:cnpj,null',
            'razao_social' => 'required_if:cnpj,null',
            'telefone_1' => 'required',
            'telefone_2' => 'nullable',

            'contatos' => 'required|array|min:1',
            'contatos.*.nome' => 'required',
            'contatos.*.cpf' => 'required',
            'contatos.*.telefone_1' => 'required',
            'contatos.*.telefone_2' => 'nullable',
        ];
    }
}
