<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateLessonRequest extends FormRequest
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
                Rule::unique('lessons')->ignore($this->lesson), //valida o campo name como unico, mas exceto quando for do ID informado
            ],
            'video' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('lessons')->ignore($this->lesson), //valida o campo name como unico, mas exceto quando for do ID informado
            ],
            'description' => [
                'required',
                'min:3',
                'max:9999',
                Rule::unique('lessons')->ignore($this->lesson), //valida o campo name como unico, mas exceto quando for do ID informado
            ],
        ];
    }
}
