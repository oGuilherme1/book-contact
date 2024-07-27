<?php

namespace Src\Contacts\Infra\Requests\CreateContact;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Src\Contacts\Application\Commands\CreateContact\CreateContactCommand;

class CreateContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está sendo usado por outro usuário.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.regex' => 'O campo telefone deve ter apenas números.',
            'phone.min' => 'O campo telefone deve ter pelo menos 11 caracteres.',
            'image.required' => 'O campo imagem é obrigatório.',
            'image.image' => 'O campo imagem deve ser uma imagem.',
            'image.mimes' => 'O campo imagem deve ser uma imagem do tipo jpeg, png, jpg ou gif.',
            'image.max' => 'O campo imagem deve ter no màximo 2 MB.'
        ];
    }


    public function toCommand(): CreateContactCommand
    {
        return new CreateContactCommand(
            null,
            $this->user()->id,
            ...$this->validated()
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
