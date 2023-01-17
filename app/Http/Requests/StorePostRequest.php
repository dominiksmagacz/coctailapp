<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'unique:posts', 'max:255'],
            'content' => ['required', 'max:2048'],
            'image_path' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
