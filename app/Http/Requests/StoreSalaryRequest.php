<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSalaryRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'user_id' => 'required|exists:users,id',
            'count' => ['required','numeric','gt:0',],
            'amount_type' => ['required','string','in:cash,card,bank',],
            'description' => ['required','string','max:2000',],
        ];
    }

    public function messages(): array{
        return [
            'count.required' => 'Ish haqi summasini kiritish majburiy.',
            'count.numeric' => 'Ish haqi summasi faqat raqamlardan iborat bo‘lishi kerak.',
            'count.gt' => 'Ish haqi summasi noldan katta bo‘lishi shart.',            
            'amount_type.required' => 'To‘lov turini tanlash majburiy.',
            'amount_type.in' => 'Noto‘g‘ri to‘lov turi tanlandi.',            
            'description.required' => 'Xodim lavozimini yozish majburiy.',
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
