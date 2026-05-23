<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMaxsulotKirimRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'type' => ['required', 'string', 'in:input_contaner,input_cover,input_label'],
            'count' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array{
        return [
            'type.required' => 'Mahsulot turini tanlash majburiy.',
            'type.in' => 'Noto‘g‘ri mahsulot turi tanlandi.',
            'count.required' => 'Mahsulot sonini kiritish majburiy.',
            'count.integer' => 'Mahsulot soni faqat butun raqam bo‘lishi kerak.',
            'count.min' => 'Mahsulot soni kamida 1 ta bo‘lishi kerak.',
            'description.required' => 'Mahsulot tavsifini yozish majburiy.',
            'description.max' => 'Tavsif 1000 ta belgidan oshmasligi kerak.',
        ];
    }
    
    protected function prepareForValidation(){
        if ($this->has('count')) {
            $cleanCount = preg_replace('/[^0-9]/', '', $this->count);
            $this->merge([
                'count' => $cleanCount,
            ]);
        }
    }

    
}
