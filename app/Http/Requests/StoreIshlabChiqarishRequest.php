<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreIshlabChiqarishRequest extends FormRequest{
    public function authorize(): bool{
        return true; 
    }
    public function rules(): array{
        $ombor = $this->route('ombor') ?? $this->ombor; 
        $maxIdish = $ombor ? min($ombor->full_cover, $ombor->empty_contaner) : 999999;
        $maxYorliq = $ombor ? $ombor->full_label : 999999;
        return [
            'empty_contaner' => ['required', 'integer', 'min:1', "max:{$maxIdish}"],
            'full_label' => ['required', 'integer', 'min:1', "max:{$maxYorliq}"],
            'description' => ['required', 'string', 'min:2', 'max:2000'],
        ];
    }
    public function messages(): array{
        return [
            'empty_contaner.required' => 'Ishlab chiqarish miqdorini kiritish majburiy.',
            'empty_contaner.integer' => 'Miqdor faqat butun son bo\'lishi kerak.',
            'empty_contaner.min' => 'Ishlab chiqarish miqdori kamida 1 ta bo\'lishi kerak.',
            'empty_contaner.max' => 'Kiritilgan miqdor ombordagi mavjud xomashyodan (qopqoq yoki idish) oshib ketdi.',
            'full_label.required' => 'Ishlatilgan yorliqlar miqdorini kiritish majburiy.',
            'full_label.integer' => 'Yorliqlar miqdori butun son bo\'lishi kerak.',
            'full_label.min' => 'Yorliqlar miqdori kamida 1 ta bo\'lishi kerak.',
            'full_label.max' => 'Kiritilgan yorliqlar miqdori ombordagi qoldiqdan ko\'p.',
            'description.required' => 'Ishlab chiqarish haqida izoh qoldirish majburiy.',
            'description.min' => 'Izoh juda qisqa (kamida 5 ta belgi).',
        ];
    }
}
