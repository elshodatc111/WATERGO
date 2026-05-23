<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'phone' => ['required','string','max:20',
                Rule::unique('orders')->where(function ($query) {
                    return $query->whereIn('status', ['new', 'pending']);
                })],
            'order_count' => ['required', 'integer', 'min:1'],
            'address'     => ['required', 'string', 'max:500'],
            'region_id'   => ['required', 'exists:regions,id'],
        ];
    }

    public function messages(): array{
        return [
            'phone.required'       => 'Telefon raqamini kiritish majburiy.',
            'phone.unique'         => 'Ushbu telefon raqami bilan faol (yangi yoki kutilayotgan) buyurtma allaqachon mavjud.',
            'order_count.required' => 'Buyurtma sonini kiritish majburiy.',
            'order_count.integer'  => 'Buyurtma soni butun son bo\'lishi kerak.',
            'order_count.min'      => 'Buyurtma soni kamida 1 ta bo\'lishi kerak.',
            'address.required'     => 'Yetqazish manzilini kiritish majburiy.',
            'region_id.required'   => 'Yetqazish hududini tanlang.',
            'region_id.exists'     => 'Tanlangan hudud tizimda mavjud emas.',
        ];
    }
}
