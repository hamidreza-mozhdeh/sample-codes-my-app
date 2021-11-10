<?php

namespace App\Http\Requests;

use App\Models\Client;

class ClientUpdateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Client::rules();

        arrayForgetValue($rules['image'], 'required');
        arrayForgetValue($rules['email'], 'unique:clients');
        $rules['email'][] = 'unique:clients,email,' . $this->client->id;

        return $rules;
    }
}
