<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationCategoryStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:65'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'description' => ['required', 'string'],
            'slug' => ['nullable'],
            'photo' => ['required', 'max:2048'],
        ];
    }
}
