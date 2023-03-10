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
            'List_Classes.*.Name_Class'=>'required',
            'List_Classes.*.Name_Class_en'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'Name_Class.required'=>trans('validation.required'),
            'Name_Class.unique'=>trans('validation.unique'),
            'Name_Class_en.required'=>trans('validation.required'),
            'Name_Class_en.unique'=>trans('validation.unique'),
        ];
    }
}
