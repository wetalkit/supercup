<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class ListingRequest extends FormRequest
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
        $rules = [
            'title' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
            'pictures.*' => ['mimes:jpeg,jpg,png,bmp,gif,svg'],
            'no_people' => ['required', 'min:1', 'max:2'],
            'no_beds' => ['required', 'min:1', 'max:2'],
            'daterange' => ['required'],
            'contact_email' => ['email', 'required'],
            'terms_accepted' => ['required']
        ];

        if(!preg_match('/update/', Route::currentRouteName())) {
            $rules['pictures.*'][] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages['pictures.*.required'] = 'Please upload an image for the listing.';
        $messages['pictures.*.mimes'] = 'The uploaded file must be an image.';
        
        return $messages;
    }
}
