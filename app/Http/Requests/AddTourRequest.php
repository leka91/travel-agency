<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTourRequest extends FormRequest
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
            'category_id'      => 'required|integer',
            'title'            => 'required|string|max:255',
            'subtitle'         => 'required|string|max:255',
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'steps'            => 'nullable|string',
            'about'            => 'nullable|string',
            'concept'          => 'nullable|string',
            'requirements'     => 'nullable|array',
            'heroimage'        => 'nullable',
            'gallery'          => 'nullable',
            'price'            => 'nullable|integer',
            'locations'        => 'nullable|array|max:10',
            'locations.*.lat'  => 'nullable|numeric|between:-90,90',
            'locations.*.lng'  => 'nullable|numeric|between:-180,180'
        ];
    }

    public function messages()
    {
        return [
            'heroimage.required'      => 'Please select Hero image',
            'locations.*.lat.numeric' => 'Latitude must be numeric',
            'locations.*.lng.numeric' => 'longitude must be numeric',
            'locations.*.lat.between' => 'The latitude must be in range between -90 and 90',
            'locations.*.lng.between' => 'The longitude must be in range between -180 and 180'
        ];
    }
}
