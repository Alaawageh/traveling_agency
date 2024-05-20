<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCity extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'num_days' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
            'latitude' => 'required',
            'longitude' => 'required'
         ];
    }
}
