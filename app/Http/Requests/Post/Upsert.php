<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class Upsert extends FormRequest
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
        // dd(request());

        $rules = [
            'title' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'author' => 'required|string|min:3|regex:/([A-Za-z])+/',
            'status' => 'not_in:default|required',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['banner'] = 'nullable|image';
        } else {
            $rules['banner'] = 'required|image';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'author.regex' => "Only letters and whitespaces are allowed.",
            'category_id.exists'=> "Please select a category.",
            'status' => 'Please select a status.'
        ];
    }
}
