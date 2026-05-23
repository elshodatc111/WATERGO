<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreIdishChiqimRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'count' => ['required', 'integer', 'min:1'], 
            'type' => ['required', 'string', 'in:empty_contaner,defect_contaner,full_contaner'],
            'description' => ['required', 'string', 'min:2', 'max:1000'],
        ];
    }
    
    public function messages(): array{
        return [
            'count.required' => 'Nosoz idishlar sonini kiritish majburiy.',
            'count.integer' => 'Idishlar soni butun son bo\'lishi kerak.',
            'count.min' => 'Idishlar soni kamida 1 ta bo\'lishi kerak.',            
            'type.required' => 'Chiqim turini tanlash majburiy.',
            'type.in' => 'Noto\'g\'ri chiqim turi tanlandi.',            
            'description.required' => 'Chiqim haqida ma\'lumot kiritish majburiy.',
            'description.min' => 'Tavsif juda qisqa (kamida 2 ta belgi).',
        ];
    }

}
