<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'phone_number' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . auth()->id(),
            'name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'main_image' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.string' => 'Поле "Номер телефона" должно быть строкой.',
            'phone_number.max' => 'Поле "Номер телефона" не должно превышать 255 символов.',
            'email.email' => 'Поле "email" должно быть действительным email адресом.',
            'email.unique' => 'Этот адрес электронной почты уже занят.',
            'name.string' => 'Поле "Имя" должно быть строкой.',
            'name.max' => 'Поле "Имя" не должно превышать 255 символов.',
            'surname.string' => 'Поле "Фамилия" должно быть строкой.',
            'surname.max' => 'Поле "Фамилия" не должно превышать 255 символов.',
            'city.string' => 'Поле "Город" должно быть строкой.',
            'city.max' => 'Поле "Город" не должно превышать 255 символов.',
            'city.required' => 'Поле "Город" обязательно',
        ];
    }
}
