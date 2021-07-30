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
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'locations' => 'nullable|array|max:10',
            'hero_image' => 'nullable'
        ];
    }
}
