<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subcategory_id' => [
                'required',
                'exists:subcategories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses', 'name')
                    ->ignore($this->course),
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses', 'slug')
                    ->ignore($this->course),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'subcategory_id.required' => 'A subcategoria é obrigatória.',
            'subcategory_id.exists' => 'A subcategoria selecionada é inválida.',

            'name.required' => 'O nome do curso é obrigatório.',
            'name.string' => 'O nome do curso deve ser um texto.',
            'name.max' => 'O nome do curso não pode ter mais de 255 caracteres.',
            'name.unique' => 'Já existe um curso com este nome.',

            'slug.required' => 'O slug do curso é obrigatório.',
            'slug.string' => 'O slug do curso deve ser um texto.',
            'slug.max' => 'O slug não pode ter mais de 255 caracteres.',
            'slug.unique' => 'Já existe um curso com este slug.',

            'description.string' => 'A descrição deve ser um texto.',

            'image.string' => 'O caminho da imagem deve ser um texto.',
            'image.max' => 'O caminho da imagem não pode ter mais de 255 caracteres.',

            'status.boolean' => 'O status informado é inválido.',
        ];
    }
}
