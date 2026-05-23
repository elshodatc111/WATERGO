<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KassaChiqimRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'count' => ['required','numeric','min:0'],
            'type' => ['required','string',Rule::in(['cash', 'card', 'bank']),],
            'description' => ['required','string','min:2','max:1000',],
        ];
    }

    public function messages(): array{
        return [
            'count.required' => 'Chiqim summasini kiritish majburiy.',
            'count.numeric' => 'Chiqim summasi raqam bo‘lishi kerak.',
            'count.min' => 'Chiqim summasi 0 dan yuqori bo‘lishi kerak.',
            'type.required' => 'Chiqim turini tanlang.',
            'type.in' => 'Tanlangan chiqim turi tizimda mavjud emas.',            
            'description.required' => 'Chiqim haqida ma’lumot kiritish majburiy.',
            'description.min' => 'Chiqim haqidagi ma’lumot kamida 3 ta belgidan iborat bo‘lishi kerak.',
            'description.max' => 'Chiqim haqidagi ma’lumot juda uzun (maksimal 1000 ta belgi).',
        ];
    }
}
