<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountSettingRequest extends FormRequest
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
            'userid' => 'required',
            'em_name' => 'required',
            'em_birth' => 'required|date_format:Y-m-d',
            'em_email' => 'required|email',
            'em_gender' => ['required', Rule::in([0, 1, 2])],
            'em_password' => 'required|confirmed',
            'em_phone' => 'required|regex:/^1[3456789]\d{9}$/',
            'em_password_confirmation' => 'required',
        ];
    }
}
