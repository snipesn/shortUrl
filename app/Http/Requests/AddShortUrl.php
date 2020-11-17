<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddShortUrl extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source_url' => 'required|url',
            'ttl' => 'required|numeric|min:1|max:10000000'
        ];
    }
}
