<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                'unique:courses',
            ],
            'image' => [
                'nullable',
                'image',
                'max:1024'
            ],
            'description' => [
                'nullable',
                'min:3',
                'max:9999',
            ],
            'available' => [
                'nullable',
                'boolean',
            ]
        ];
    }
}
