<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;


class AuthService extends Controller
{

    protected function storeVerificationData($verificationCode): void
    {
        session()->put('verification_code', [
            'code' => $verificationCode,
            'created_at' => now(),
        ]);
    }
    public function sendSMS($data,$code): JsonResponse
    {
        $this->storeVerificationData($code);
        $response = Http::post(env('SMS_API') .'/sms/send' , [
            'user' => env('SMS_LOGIN'),
            'pass' => env('SMS_PASSWORD'),
            'to' => $data['phone_number'],
            'txt' => 'Ваш код для авторизации: '.$code,
            'from' => 'PerevozkiOnline',
        ]);
        return response()->json(['data'=>$response]);
    }
}
