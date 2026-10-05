<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubcategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',

                Rule::unique('subcategories', 'name')
                    ->where(function ($query) {
                        return $query->where(
                            'category_id',
                            $this->category_id
                        );
                    })
                    ->ignore($this->subcategory),
            ],

            'active' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria selecionada não existe.',

            'name.required' => 'O nome da subcategoria é obrigatório.',
            'name.string' => 'O nome da subcategoria deve ser um texto.',
            'name.max' => 'O nome da subcategoria não pode ultrapassar 255 caracteres.',
            'name.unique' => 'Já existe uma subcategoria com este nome nesta categoria.',

            'active.required' => 'O status da subcategoria é obrigatório.',
            'active.boolean' => 'O status da subcategoria é inválido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'categoria',
            'name' => 'nome da subcategoria',
            'active' => 'status',
        ];
    }
}