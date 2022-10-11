<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourStoreRequest extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255'],
            'days' => ['required', 'numeric', 'max:99'],
            'best_time' => ['nullable', 'string', 'max:100'],
            'price' => ['nullable', 'numeric'],
            'description' => ['required'],
            'photo' => ['required', 'image', 'max:1000'],
            'categories' => ['required', 'numeric'],
            //'tour_categories' => ['array'],
           // 'added_categories' => ['array'],
        ];
    }
}
