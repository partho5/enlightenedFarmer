<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FarmerRegRequest extends FormRequest
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
            'name' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'upozilla' => 'required',
            'nidNo' => 'required',
            'crop_type' => 'required',
//            'lat' => 'required',
//            'long' => 'required'
        ];
    }
    
    public function attributes() {
        return [
            'nidNo' => 'NID Number',
            'lat' => 'Geolocation',
            'long' => 'Geolocation',
            'upozilla' => 'Upozilla'
        ];
    }
}
