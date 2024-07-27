<?php

namespace Src\Contacts\Infra\Requests\DeleteContact;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Src\Contacts\Application\Commands\DeleteContact\DeleteContactCommand;

class DeleteContactRequest extends FormRequest
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
            'id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O campo id é obrigatório.',
            'id.integer' => 'O campo id deve ser um número.',
        ];
    }


    public function toCommand(): DeleteContactCommand
    {
        return new DeleteContactCommand(
            ...$this->validated()
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
