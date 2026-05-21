<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    protected function prepareForValidation(): void{
        $this->merge([
            'phone' => preg_replace('/[^0-9+]/', '', $this->phone),
            'balans' => preg_replace('/\s+/', '', $this->balans),
        ]);
    }
    public function rules(): array{
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'phone' => ['required', 'regex:/^\+998[0-9]{9}$/', 'unique:users,phone'], 
            'type' => ['required', 'string', 'in:drektor,operator,currer,omborchi'],
            'balans' => ['required', 'numeric', 'min:0', 'max:999999999'],
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'Xodimning F.I.O. kiritilishi shart.',
            'name.min' => 'F.I.O. kamida 3 ta harfdan iborat bo\'lishi kerak.',
            'phone.required' => 'Telefon raqami kiritilishi shart.',
            'phone.regex' => 'Telefon raqami formati noto\'g\'ri.',
            'phone.unique' => 'Ushbu telefon raqami allaqachon ro\'yxatga olingan.',
            'type.required' => 'Xodim lavozimini tanlang.',
            'type.in' => 'Tanlangan lavozim tizimda mavjud emas.',
            'balans.required' => 'Oylik ish haqi kiritilishi shart.',
            'balans.numeric' => 'Oylik ish haqi faqat raqamlardan iborat bo\'lishi kerak.',
            'balans.min' => 'Oylik ish haqi noldan kam bo\'lishi mumkin emas.',
        ];
    }
}
