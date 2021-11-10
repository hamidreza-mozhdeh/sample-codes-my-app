<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Support\Arr;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Admin::rules();

        arrayForgetValue($rules['email'], 'required', 'confirmed', 'unique:admins');
        arrayForgetValue($rules['password'], 'required', 'confirmed');

        return Arr::only($rules, ['email', 'password']);
    }
}
