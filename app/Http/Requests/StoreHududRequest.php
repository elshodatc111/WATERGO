<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreHududRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'name' => 'required|string|max:255|unique:regions,name',
            'description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Hudud nomini kiritish majburiy.',
            'name.string' => 'Hudud nomi matn formatida bo\'lishi kerak.',
            'name.max' => 'Hudud nomi 255 ta belgi dan oshmasligi kerak.',
            'name.unique' => 'Bunday nomli hudud allaqachon mavjud.',
            'description.required' => 'Hudud tavsifini kiritish majburiy.',
            'description.string' => 'Hudud tavsifi matn formatida bo\'lishi kerak.',
            'description.max' => 'Hudud tavsifi 1000 ta belgi dan oshmasligi kerak.',
        ];
    }

}
