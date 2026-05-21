<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRegionRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        $regionId = $this->input('id');

        return [
            'id' => 'required|integer|exists:regions,id', // ID bazada mavjudligini tekshirish
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions', 'name')->ignore($regionId),
            ],
            'description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Hudud nomini kiritish majburiy.',
            'name.max' => 'Hudud nomi 255 ta belgidan oshmasligi kerak.',
            'name.unique' => 'Bunday nomli hudud allaqachon mavjud.',
            'description.required' => 'Hudud tavsifini kiritish majburiy.',
            'description.max' => 'Hudud tavsifi 1000 ta belgidan oshmasligi kerak.',
        ];
    }
}
