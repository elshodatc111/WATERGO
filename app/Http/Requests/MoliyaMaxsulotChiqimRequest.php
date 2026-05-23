<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MoliyaMaxsulotChiqimRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'type' => ['required','string',Rule::in(['input_contaner', 'input_label', 'input_cover']), ],
            'count' => ['required','string', 'max:255',],
            'description' => ['required','string','min:2','max:1000',],
        ];
    }
    public function messages(): array{
        return [
            'type.required' => 'Mahsulot turini tanlash majburiy.',
            'type.in' => 'Tanlangan mahsulot turi yaroqsiz.',            
            'count.required' => 'Mahsulot sonini kiritish majburiy.',            
            'description.required' => 'Mahsulot tavsifini kiritish majburiy.',
            'description.min' => 'Tavsif kamida 5 ta belgidan iborat bo\'lishi kerak.',
            'description.max' => 'Tavsif 1000 ta belgidan oshmasligi kerak.',
        ];
    }
}
