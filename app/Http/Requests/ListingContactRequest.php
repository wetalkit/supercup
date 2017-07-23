<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ListingContactRequest extends FormRequest
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
            'email' => 'required|email',
            'message' => 'required',
        ];
    }

    /**
     * Format Errors
     * 
     * @param  Validator $validator [description]
     * 
     * @return [type]               [description]
     */
    public function formatErrors(Validator $validator)
    {
        return [
            'response' => false,
            'data' => $validator->errors()->all()
        ];
    }
}
