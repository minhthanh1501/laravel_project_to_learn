<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'required|unique:sliders|max:255',
            'description' => 'required',
            'image_path' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được trống',
            'name.unique' => 'Tên không được trùng',
            'name.max' => 'Tên phải có dưới 255 kí tự',
            'description.required' => 'Mô tả không được trống',
            'image_path.required' => 'Hình ảnh không được trống',
        ];
    }
}
