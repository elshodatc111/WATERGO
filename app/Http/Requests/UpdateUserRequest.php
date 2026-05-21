<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest{
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
        $userId = $this->input('id');
        return [
            'id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255', 'min:3'],            
            'phone' => [
                'required', 
                'regex:/^\+998[0-9]{9}$/', 
                Rule::unique('users', 'phone')->ignore($userId),
            ],            
            'type' => ['required', 'string', 'in:drektor,operator,currer,omborchi'],
            'balans' => ['required', 'numeric', 'min:0', 'max:999999999'],
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'Xodim ismini kiritish shart.',
            'name.min' => 'Ism kamida 3 ta harfdan iborat bo\'lishi kerak.',
            'phone.required' => 'Telefon raqami kiritilishi shart.',
            'phone.regex' => 'Telefon raqami formati noto\'g\'ri (+998XXXXXXXXX).',
            'phone.unique' => 'Ushbu telefon raqami boshqa xodimga biriktirilgan.',
            'type.required' => 'Xodim lavozimini tanlang.',
            'type.in' => 'Tizimda bunday lavozim mavjud emas.',
            'balans.required' => 'Oylik ish haqini kiritish shart.',
            'balans.numeric' => 'Ish haqi raqamlardan iborat bo\'lishi kerak.',
            'balans.min' => 'Ish haqi noldan kam bo\'lishi mumkin emas.',
        ];
    }
}
