<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:100',
            'mobile' =>'required|max:100|unique:vendors,mobile,'.$this -> id,
            'email'  => 'required|email|unique:vendors,email,'.$this -> id,
            'category_id'  => 'required|exists:main_categories,id',
            //'address'   => 'required|string|max:500',
            'password'   => 'required_without:id'
        ];
    }


    public function messages(){

        return [
            'required'  => 'this field is required',
            'max'  => 'you depassed the max characters',
            'category_id.exists'  => 'Category not found ',
            'email.email' => 'Please enter a valid email',
            //'address.string' => 'Address not valid ',
            'name.string'  =>'Name is a string ',
            'logo.required_without'  => 'Required photo type',
            'email.unique' => 'this email is already using ',
            'mobile.unique' => 'this phone number is already using ',


        ];
    }

}
