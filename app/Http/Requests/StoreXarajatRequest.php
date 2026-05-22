<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreXarajatRequest extends FormRequest{
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
            'count.required' => 'Xarajat summasini kiritish majburiy.',
            'count.numeric' => 'Xarajat summasi faqat raqamlardan iborat bo‘lishi kerak.',
            'count.gt' => 'Xarajat summasi noldan katta bo‘lishi shart.',            
            'pay_type.required' => 'Xarajat turini tanlash majburiy.',
            'pay_type.in' => 'Noto‘g‘ri xarajat turi tanlandi.',            
            'description.required' => 'Xarajat tavsifini yozish majburiy.',
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
