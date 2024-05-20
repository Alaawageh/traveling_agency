<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCountry extends FormRequest
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
            'name' => 'required|max:60|string',
            'population' => 'required|numeric',
            'territory' => 'required|numeric',
            'avg_price' => 'required|numeric',
            'description' => 'sometimes|string',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'continent' =>'required|max:60|string',
        ];
    }
}
