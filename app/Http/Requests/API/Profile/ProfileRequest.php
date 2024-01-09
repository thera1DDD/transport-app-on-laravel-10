<?php

namespace App\Http\Requests\API\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'users_id' => 'required|integer',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . auth()->id(),
            'name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'phone_number.string' => 'Поле "phone_number" должно быть строкой.',
            'phone_number.max' => 'Поле "phone_number" не должно превышать 255 символов.',
            'email.email' => 'Поле "email" должно быть действительным email адресом.',
            'email.unique' => 'Данный email адрес уже используется другим пользователем.',
            'name.string' => 'Поле "name" должно быть строкой.',
            'name.max' => 'Поле "name" не должно превышать 255 символов.',
            'city.string' => 'Поле "city" должно быть строкой.',
            'city.max' => 'Поле "city" не должно превышать 255 символов.',
        ];
    }
}
