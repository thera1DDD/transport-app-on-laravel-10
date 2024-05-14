<?php

namespace App\Http\Requests\Offer;

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
            'requested_users_id' => 'nullable',
            'routings_id' => 'nullable',
            'status' => 'nullable',
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
