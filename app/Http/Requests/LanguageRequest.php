<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name'=>'required|string|max:100',
            'abbr'=>'required|string|max:10',
            'direction'=>'required|in:rtl,ltr',
            'active'=>'in:0,1',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'failed',
            'string'=>'Please use valid characters',
            'abbr.max'=>'You should write less than 10 characters',
            'name.max'=>'You should write less than 100 characters',


        ];
    }
}
