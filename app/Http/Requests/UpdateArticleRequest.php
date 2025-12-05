<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'body'        => 'required|string|min:10',
            'image'       => 'nullable|image|max:2048',
        ];
    }
}
