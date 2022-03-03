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
            'category_id'         => 'required|integer',
            'is_popular'          => 'boolean',
            'title'               => 'required|string|max:255|unique:tours',
            'subtitle'            => 'required|string|max:255',
            'meta_keywords'       => 'required|string|max:255',
            'meta_description'    => 'required|string|max:255',
            'description'         => 'required|string',
            'requirements'        => 'nullable|array',
            'tags'                => 'nullable|array',
            'heroimage'           => 'required',
            'gallery'             => 'nullable',
            'videos'              => 'nullable|array',
            'videos.*.video_link' => 'nullable|url|string|max:255',
            'prices'              => 'array|max:3',
            'prices.0.name'       => 'required',
            'prices.0.amount'     => 'required',
            'prices.*.name'       => 'nullable|required_with:prices.*.amount|string',
            'prices.*.amount'     => 'nullable|required_with:prices.*.name|numeric',
            'locations'           => 'nullable|array|max:10',
            'locations.*.lat'     => 'nullable|required_with:locations.*.lng|numeric|between:-90,90',
            'locations.*.lng'     => 'nullable|required_with:locations.*.lat|numeric|between:-180,180'
        ];
    }

    public function messages()
    {
        return [
            'heroimage.required'            => 'Please select Hero image',
            'prices.0.name.required'        => 'People field is required',
            'prices.0.amount.required'      => 'Amount field is required',
            'prices.*.name.string'          => 'People must be string',
            'prices.*.amount.numeric'       => 'Amount must be numeric',
            'prices.*.name.required_with'   => 'People field is required',
            'prices.*.amount.required_with' => 'Amount field is required',
            'locations.*.lat.numeric'       => 'Latitude must be numeric',
            'locations.*.lng.numeric'       => 'Longitude must be numeric',
            'locations.*.lat.required_with' => 'Latitude field is required',
            'locations.*.lng.required_with' => 'Longitude field is required',
            'locations.*.lat.between'       => 'Latitude must be in range between -90 and 90',
            'locations.*.lng.between'       => 'Longitude must be in range between -180 and 180',
            'videos.*.video_link.url'       => 'Video link format is invalid'
        ];
    }
}
