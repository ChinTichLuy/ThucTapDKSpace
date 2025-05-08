<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() {
        return [
            'title' => 'required|unique:posts,title',
            'content' => 'required|min:20',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc!',
            'title.unique' => 'Tiêu đề đã tồn tại!',
            'content.required' => 'Nội dung bài viết là bắt buộc!',
            'content.min' => 'Nội dung bài viết phải ít nhất 20 ký tự!',
        ];
    }

}
