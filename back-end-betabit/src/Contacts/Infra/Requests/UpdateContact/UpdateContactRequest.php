<?php

namespace Src\Contacts\Infra\Requests\UpdateContact;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Src\Contacts\Application\Commands\UpdateContact\UpdateContactCommand;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

        /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('id')) {
            $this->merge([
                'id' => (int) $this->input('id'),
            ]);
        }

        if ($this->has('image') && is_string($this->input('image'))) {
            $this->merge([
                'image' => null,
            ]);
        }
        
        // foreach (['name', 'email', 'phone', 'image'] as $field) {
        //     if ($this->has($field) && $this->input($field) === "null") {
        //         $this->merge([
        //             $field => null,
        //         ]);
        //     }
        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' =>    'required|integer',
            'name' =>  'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O campo id é obrigatório.',
            'id.string' => 'O campo id deve ser um número.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'phone.regex' => 'O campo telefone deve ter apenas números.',
            'phone.min' => 'O campo telefone deve ter pelo menos 11 caracteres.',
            'image.image' => 'O campo imagem deve ser uma imagem.',
            'image.mimes' => 'O campo imagem deve ser uma imagem do tipo jpeg, png, jpg ou gif.',
            'image.max' => 'O campo imagem deve ter no màximo 2 MB.'
        ];
    }


    public function toCommand(): UpdateContactCommand
    {
        return new UpdateContactCommand(
            ...$this->validated()
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
