<?php

namespace Modules\UserAndRoles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required',
            'email'            => 'required|email',
            'phone_no'          => 'required|numeric',
            'password'          => 'required',
            'confirm_password' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'Email must be a valid email address!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!',
            'confirm_password.required' => 'Confirm Password is required!',
            'phone_no.required' => 'Phone Number is required!',
            'phone_no.numeric' => 'Phone Number must be a Number!'

        ];
    }
}
