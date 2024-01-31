<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'nullable',
            'surname' => 'nullable',
            'patronymic' => 'nullable',
            'city' => 'nullable',
            'main_image' => 'nullable',
            'transport' => 'nullable',
            'phone_number' => 'nullable',
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'requested_users_id.required' => 'Поле Заявка от обязательно для заполнения.',
//            'routings_id.required' => 'Поле Маршруты обязательно для заполнения.',
//            'status.required' => 'Поле Статус обязательно для заполнения.',
//            'status.in' => 'Неверное значение для поля Статус.',
//        ];
//    }
}
