<?php

namespace App\Http\Requests\Routing;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'route_type' => 'nullable|in:carrier,sender',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'from_place' => 'nullable|string|max:255',
            'to_place' => 'nullable|string|max:255',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'load_type' => 'nullable|string|max:255',
            'load_size' => 'nullable|string|max:255',
            'owners_id' => 'nullable|exists:users,id',
            'status' => 'nullable|in:accepted,waiting',
        ];
    }
    public function messages(): array
    {
        return [
            'route_type.in' => 'Выбрано неверное значение для поля Тип.',
            'name.string' => 'Поле Имя должно быть строкой.',
            'name.max' => 'Поле Имя не должно превышать 255 символов.',
            'description.string' => 'Поле Описание должно быть строкой.',
            'price.numeric' => 'Поле Цена должно быть числом.',
            'from_place.string' => 'Поле Откуда должно быть строкой.',
            'from_place.max' => 'Поле Откуда не должно превышать 255 символов.',
            'to_place.string' => 'Поле Куда должно быть строкой.',
            'to_place.max' => 'Поле Куда не должно превышать 255 символов.',
            'start_time.date' => 'Поле Начало должно быть датой.',
            'end_time.date' => 'Поле Конец должно быть датой.',
            'load_type.string' => 'Поле Тип груза должно быть строкой.',
            'load_type.max' => 'Поле Тип груза не должно превышать 255 символов.',
            'load_size.string' => 'Поле Размер груза должно быть строкой.',
            'load_size.max' => 'Поле Размер груза не должно превышать 255 символов.',
            'owners_id.exists' => 'Выбранный владелец не существует.',
            'status.in' => 'Выбрано неверное значение для поля Статус.',
        ];
    }
}
