<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDaromadChiqimRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'count' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'pay_type' => [
                'required',
                'string',
                'in:cash,card,bank',
            ],
            'description' => [
                'required',
                'string',
                'max:2000',
            ],
        ];
    }

    public function messages(): array{
        return [
            'count.required' => 'Daromad summasini kiritish majburiy.',
            'count.numeric' => 'Summa faqat raqamlardan iborat bo‘lishi kerak.',
            'count.gt' => 'Daromad summasi manfiy yoki nol bo‘lishi mumkin emas. Noldan katta summa kiriting.',            
            'pay_type.required' => 'Daromad turini tanlash majburiy.',
            'pay_type.in' => 'Tizimda mavjud bo‘lmagan to‘lov turi tanlandi.',            
            'description.required' => 'Daromad tavsifini yozish majburiy.',
            'description.max' => 'Tavsif juda uzun (maksimal 2000 ta belgi).',
        ];
    }

    protected function prepareForValidation(){
        if ($this->has('count')) {
            $cleanCount = preg_replace('/[^0-9.]/', '', $this->count);
            $this->merge([
                'count' => $cleanCount,
            ]);
        }
    }

}
