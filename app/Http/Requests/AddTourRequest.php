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
            'category_id'  => 'required|integer',
            'title'        => 'required|string|max:255',
            'subtitle'     => 'required|string|max:255',
            'requirements' => 'nullable|array',
            'locations'    => 'nullable|array|max:10',
            'heroimage'    => 'nullable',
            'gallery'      => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'heroimage.required' => 'Please select Hero image'
        ];
    }
}
