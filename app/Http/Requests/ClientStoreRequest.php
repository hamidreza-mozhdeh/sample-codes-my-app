<?php

namespace App\Http\Requests;

use App\Models\Client;

class ClientStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Client::rules();
    }
}
