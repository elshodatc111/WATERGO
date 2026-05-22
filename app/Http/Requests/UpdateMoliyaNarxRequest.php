<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMoliyaNarxRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'price_contaner' => ['required', 'string', 'max:255'],
            'price_water'    => ['required', 'string', 'max:255'],
        ];
    }
    public function messages(): array{
        return [
            'price_contaner.required' => "Bo'sh idish narxini kiritish majburiy.",
            'price_water.required'    => "Suv narxini kiritish majburiy.",
        ];
    }
}
