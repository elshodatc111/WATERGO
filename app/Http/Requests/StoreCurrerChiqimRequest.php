<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCurrerChiqimRequest extends FormRequest{
    
    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        $ombor = $this->route('ombor') ?? $this->ombor;
        $maxMaxsulot = $ombor ? $ombor->full_contaner : 999999;
        return [
            'currer_id' => ['required', 'exists:users,id'],
            'count' => ['required', 'integer', 'min:1', "max:{$maxMaxsulot}"],
            'description' => ['required', 'string', 'min:2', 'max:2000'],
        ];
    }

    public function messages(): array{
        return [
            'currer_id.required' => 'Xaydovchini tanlash majburiy.',
            'currer_id.exists' => 'Tanlangan xaydovchi tizimda mavjud emas.',
            'count.required' => 'Chiqim qilinadigan mahsulotlar sonini kiriting.',
            'count.integer' => 'Mahsulotlar soni faqat butun son bo\'lishi kerak.',
            'count.min' => 'Kamida 1 ta mahsulot chiqim qilinishi kerak.',
            'count.max' => 'Chiqim miqdori ombordagi tayyor mahsulotlar qoldig\'idan oshib keta olmaydi.',
            'description.required' => 'Chiqim haqida izoh qoldirish majburiy.',
            'description.min' => 'Izoh juda qisqa (kamida 5 ta belgi).',
        ];
    }

}
