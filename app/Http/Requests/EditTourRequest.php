<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTourRequest extends FormRequest
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
            'title'            => [
                'required',
                'string',
                'max:255',
                Rule::unique('tours', 'title')->ignore($this->tour)
            ],
            'subtitle'         => 'required|string|max:255',
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'requirements'     => 'nullable|array',
            'heroimage'        => 'nullable',
            'gallery'          => 'nullable',
            'price'            => 'nullable|integer',
            'locations'        => 'nullable|array|max:10',
            'locations.*.lat'  => 'nullable|required_with:locations.*.lng|numeric|between:-90,90',
            'locations.*.lng'  => 'nullable|required_with:locations.*.lat|numeric|between:-180,180'
        ];
    }

    public function messages()
    {
        return [
            'heroimage.required'            => 'Please select Hero image',
            'locations.*.lat.numeric'       => 'Latitude must be numeric',
            'locations.*.lng.numeric'       => 'Longitude must be numeric',
            'locations.*.lat.required_with' => 'Latitude is required when longitude is present',
            'locations.*.lng.required_with' => 'Longitude is required when latitude is present',
            'locations.*.lat.between'       => 'Latitude must be in range between -90 and 90',
            'locations.*.lng.between'       => 'Longitude must be in range between -180 and 180'
        ];
    }
}
