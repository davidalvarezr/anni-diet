<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FireworkBroadcast extends FormRequest
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
            'type' => 'string',
            'x' => ['regex:/^-*(\d+[.,]\d+|\d+)$/'],
            'y' => ['regex:/^-*(\d+[.,]\d+|\d+)$/'],
            'z' => ['regex:/^-*(\d+[.,]\d+|\d+)$/'],
        ];
    }
}
