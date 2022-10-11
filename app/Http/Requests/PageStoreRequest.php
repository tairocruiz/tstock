<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
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
            'name' => ['string', 'required', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:65'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'description' => ['required'],
            'resource' => ['nullable', 'max:2'],
            'photo' => ['required', 'image', 'min:10', 'max:1500'],
        ];
    }
}
