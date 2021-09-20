<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BelgradeInfoRequest extends FormRequest
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
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'description'      => 'required|string'
        ];
    }
}
