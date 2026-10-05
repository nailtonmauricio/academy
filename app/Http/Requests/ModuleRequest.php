<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => [
                'required',
                'exists:courses,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'order' => [
                'required',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'O curso é obrigatório.',
            'course_id.exists' => 'O curso selecionado é inválido.',

            'name.required' => 'O nome do módulo é obrigatório.',
            'name.string' => 'O nome do módulo deve ser um texto.',
            'name.max' => 'O nome do módulo não pode ter mais de 255 caracteres.',

            'description.string' => 'A descrição do módulo deve ser um texto.',

            'order.required' => 'A ordem do módulo é obrigatória.',
            'order.integer' => 'A ordem do módulo deve ser um número inteiro.',
            'order.min' => 'A ordem do módulo deve ser maior que zero.',

            'status.required' => 'O status do módulo é obrigatório.',
            'status.boolean' => 'O status informado é inválido.',
        ];
    }
}