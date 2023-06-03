<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateCourseRequest extends FormRequest
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
        //$id = $this->segment(3); //Pega o segmento da URL /admins/courses/id
        $id = $this->course; //Pega ID pelo name do parametro

        $rules = [
            'name' => [
                'required',
                'min:3',
                'max:255',
                //"unique:courses,name,{$id},id",
                Rule::unique('courses')->ignore($id), //valida o campo name como unico, mas exceto quando for do ID informado
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

        //Alterar validação
        /*if($this->method() == 'PUT'){
            $rules['image'] = [
                'nullable',
                'image',
            ];
        }*/

        return $rules;
    }
}
