<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
        $rules = [
            'name' => 'required|string|unique:categories,name,' ,
            'is_active' => 'required|not_in:default'
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['name'] .=  $this->category->id;
        }

        return $rules;

    }
}
