<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'module_id'   => 'required|exists:modules,id',
            
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lessons', 'slug')->ignore($this->lesson),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'duration' => [
                'nullable',
                'integer',
                'min:0',
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

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da aula é obrigatório.',
            'name.string' => 'O nome da aula deve ser um texto.',
            'name.max' => 'O nome da aula não pode ter mais de 255 caracteres.',

            'slug.required' => 'O slug da aula é obrigatório.',
            'slug.string' => 'O slug da aula deve ser um texto.',
            'slug.max' => 'O slug da aula não pode ter mais de 255 caracteres.',
            'slug.unique' => 'Este slug já está sendo utilizado.',

            'description.string' => 'A descrição deve ser um texto.',

            'content.string' => 'O conteúdo da aula deve ser um texto.',

            'video_url.url' => 'Informe uma URL de vídeo válida.',
            'video_url.max' => 'A URL do vídeo não pode ter mais de 255 caracteres.',

            'duration.integer' => 'A duração deve ser um número inteiro.',
            'duration.min' => 'A duração não pode ser negativa.',

            'position.required' => 'A ordem da aula é obrigatória.',
            'position.integer' => 'A ordem deve ser um número inteiro.',
            'position.min' => 'A ordem deve ser no mínimo 1.',

            'status.required' => 'O status da aula é obrigatório.',
            'status.boolean' => 'O status informado é inválido.',
        ];
    }
}
