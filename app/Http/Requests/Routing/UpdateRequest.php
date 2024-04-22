<?php

namespace App\Http\Requests\Routing;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'route_type' => 'required|in:carrier,sender',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'from_place' => 'required|string|max:255',
            'to_place' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'load_type' => 'required|string|max:255',
            'load_size' => 'required|string|max:255',
            'owners_id' => 'required|exists:users,id',
            'status' => 'required|in:accepted,waiting',
        ];
    }

    public function messages(): array
    {
        return [
            'route_type.required' => 'Поле Тип обязательно для заполнения.',
            'route_type.in' => 'Выбрано неверное значение для поля Тип.',
            'name.required' => 'Поле Имя обязательно для заполнения.',
            'name.string' => 'Поле Имя должно быть строкой.',
            'name.max' => 'Поле Имя не должно превышать 255 символов.',
            'description.required' => 'Поле Описание обязательно для заполнения.',
            'description.string' => 'Поле Описание должно быть строкой.',
            'description.max' => 'Поле Описание не должно превышать 255 символов.',
            'price.required' => 'Поле Цена обязательно для заполнения.',
            'price.numeric' => 'Поле Цена должно быть числом.',
            'from_place.required' => 'Поле Откуда обязательно для заполнения.',
            'from_place.string' => 'Поле Откуда должно быть строкой.',
            'from_place.max' => 'Поле Откуда не должно превышать 255 символов.',
            'to_place.required' => 'Поле Куда обязательно для заполнения.',
            'to_place.string' => 'Поле Куда должно быть строкой.',
            'to_place.max' => 'Поле Куда не должно превышать 255 символов.',
            'start_time.required' => 'Поле Начало обязательно для заполнения.',
            'start_time.date' => 'Поле Начало должно быть датой.',
            'end_time.required' => 'Поле Конец обязательно для заполнения.',
            'end_time.date' => 'Поле Конец должно быть датой.',
            'load_type.required' => 'Поле Тип груза обязательно для заполнения.',
            'load_type.string' => 'Поле Тип груза должно быть строкой.',
            'load_type.max' => 'Поле Тип груза не должно превышать 255 символов.',
            'load_size.required' => 'Поле Размер груза обязательно для заполнения.',
            'load_size.string' => 'Поле Размер груза должно быть строкой.',
            'load_size.max' => 'Поле Размер груза не должно превышать 255 символов.',
            'owners_id.required' => 'Поле От кого обязательно для заполнения.',
            'owners_id.exists' => 'Выбранный владелец не существует.',
            'status.required' => 'Поле Статус обязательно для заполнения.',
            'status.in' => 'Выбрано неверное значение для поля Статус.',
        ];
    }
}
