<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourCategoryStoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'special' => ['nullable', 'numeric', 'max:1'],
            'seo_title' => ['nullable', 'string', 'max:65'],
            'meta_description' => ['required', 'string', 'max:500'],
            'description' => ['nullable' ,'string'],
            'photo' => ['required', 'image', 'max:900'],
            'slug' => ['nullable' ,'string']
        ];
    }
}
