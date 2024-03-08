<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
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
    public function sendSMS($phoneNumber,$code)
    {
        $verificationCode = mt_rand(1000, 9999);

        $response = Http::post(env('SMS_API') .'/sms/send' , [
            'user' => env('SMS_LOGIN'),
            'pass' => env('SMS_PASSWORD'),
            'to' => $phoneNumber,
            'txt' => 'Ваш код для авторизации: '.$code,
            'from' => 'PerevozkiOnline',
        ]);
        $this->storeVerificationData($code);
        return response()->json(['data'=>$response]);
    }
}
