<?php

namespace App\Http\Requests;

use App\Models\Admin;

class AdminStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Admin::rules();
    }
}
