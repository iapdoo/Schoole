<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRoom extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Name_Class'=>'required|unique:class_rooms,Name_Class->ar,'.$this->id,
            'Name_Class_en'=>'required|unique:class_rooms,Name_Class->en,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'Name_Class.required'=>trans('validation.required'),
            'Name_Class_en.required'=>trans('validation.required'),
        ];
    }
}
