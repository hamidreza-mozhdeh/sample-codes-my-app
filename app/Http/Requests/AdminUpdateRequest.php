<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Support\Arr;

class AdminUpdateRequest extends BaseRequest
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

        $rules['password'][] = 'required_unless:password_confirmation,null';
        $rules['email'][]    = 'required_unless:email_confirmation,null';
        $rules['email'][]    = 'unique:admins,email,' . $this->admin->id;

        return $rules;
    }
}
