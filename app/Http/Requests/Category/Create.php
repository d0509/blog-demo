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
            'name' => 'required|string|regex:/([A-Za-z])+/' ,
            'is_active' => 'required|not_in:default'
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => "Category field is required.",
            'name.regex' => "Only letters and whitespaces are allowed."
        ];
    }
}
