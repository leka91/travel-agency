<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBelgradeInfoRequest extends FormRequest
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
            'meta_keywords'    => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'belgradeimage'    => 'nullable',
            'description'      => 'required|string'
        ];
    }
}
