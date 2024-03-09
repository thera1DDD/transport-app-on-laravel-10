<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use GreenSMS\GreenSMS;


class AuthService extends Controller
{

    protected function storeVerificationData($verificationCode): void
    {
        session()->put('verification_code', [
            'code' => $verificationCode,
            'created_at' => now(),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function sendSMS($data, $code): JsonResponse
    {
        $client = new GreenSMS(
            [
                'user' => env('SMS_LOGIN'),
                'pass' => env('SMS_PASSWORD')
            ]
        );
        $response = $client->sms->send(
            [
                'to' => $data['phone_number'],
                'txt' => 'Ваш код для авторизации: '.$code
            ]
        );
        $this->storeVerificationData($code);
        return response()->json(['data'=>$response]);

//        $response = Http::post(env('SMS_API') .'/sms/send' , [
//            'user' => env('SMS_LOGIN'),
//            'pass' => env('SMS_PASSWORD'),
//            'to' => $data['phone_number'],
//            'txt' => 'Ваш код для авторизации: '.$code,
//            'from' => 'PerevozkiOnline',
//        ]);
    }
}
