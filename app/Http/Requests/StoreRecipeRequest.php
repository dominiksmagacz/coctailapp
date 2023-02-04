<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
            'title' => ['required', 'unique:recipes', 'max:255'],
            'description' => ['required', 'max:2048'],
            'yt_link' => ['required', 'url'],
            'image_path' => ['required', 'mimes:jpeg,png,jpg,gif,svg,JPG', 'max:5048'],
        ];
    }
}
