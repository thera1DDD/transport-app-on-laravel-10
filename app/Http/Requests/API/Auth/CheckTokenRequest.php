<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckTokenRequest extends FormRequest
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
            'users_id' => 'required|integer',
            'remember_token'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'users_id.required' => 'users_id является обязательным полем',
            'remember_token.required' => 'remember_token является обязательным полем',
        ];
    }
}
