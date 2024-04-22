<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SendSmsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone_number' => 'required|regex:/^\+?[0-9]+$/',
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.regex' => 'Некорректный формат номера телефона.',
            'phone_number.required' => 'Номер телефона является обязательным полем',
        ];
    }
}
