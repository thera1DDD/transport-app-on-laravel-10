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
            'route_type' => 'nullable|in:carrier,sender',
            'name' => 'nullable|string|max:255',
            'load_width' => 'nullable',
            'load_length' => 'nullable',
            'load_height' => 'nullable',
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
}
