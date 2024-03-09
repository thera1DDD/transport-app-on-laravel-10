<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\VerifySmsRequest;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;


class AuthService extends Controller
{

    public function sendSMS($data, $code): JsonResponse
    {
        try {
            // Проверяем существование номера телефона в базе данных
            $user = User::where('phone_number', $data['phone_number'])->first();

            if (!$user) {
                // Отправляем SMS через API
                $response = Http::post(env('SMS_API') .'/sms/send', [
                    'user' => env('SMS_LOGIN'),
                    'pass' => env('SMS_PASSWORD'),
                    'to' => $data['phone_number'],
                    'txt' => 'Ваш код для авторизации: '.$code,
                    'from' => 'Perevozki',
                ]);

                return response()->json([
                    'success' => true,
                    'data' => [
                        'green_sms_data' => $response,
                        'code' => $code,
                        'phone_number' => $data['phone_number'],
                    ],
                ]);
            } else {
                return response()->json(['error' => 'Такой номер уже существует'], 422);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    public function postUser($data): JsonResponse
    {
      $user = User::firstOrCreate
      (
          [
              'phone_number'=>$data['phone_number'],
              'token'=>$data['token']
          ]
      );
      return response()->json(['user_data'=> $user]);
    }
}
