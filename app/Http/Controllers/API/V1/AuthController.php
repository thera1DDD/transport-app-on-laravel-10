<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\SendSmsRequest;
use App\Http\Requests\API\Auth\VerifySmsRequest;
use App\Http\Requests\API\Profile\ProfileRequest;
use App\Http\Requests\API\Profile\ReplyOfferRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ProfileService;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    protected function storeVerificationData($verificationCode): void
    {
        session()->put('verification_code', [
            'code' => $verificationCode,
            'created_at' => now(),
        ]);
    }

    public function sendSMS(SendSmsRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->authService->sendSMS($data,mt_rand(1000,9999));
    }

    public function verifySMS(VerifySmsRequest $request): JsonResponse
    {
        $data = $request->validated();
        $verificationData = session('verification_code');

        if (
            !$verificationData
            || $verificationData['code'] !== $data['code']
            || now()->gt(Carbon::parse($verificationData['created_at'])->addMinute())
        ) {
            return response()->json(['message' => 'Invalid verification code'], 401);
        }

        // Создание нового пользователя в базе данных
        $user = User::create([
            'phone_number' => $verificationData['phone_number'],
            // Другие поля пользователя
        ]);

        // Генерация и присоединение токена к пользователю
        $user->token = $user->createToken('API Token')->accessToken;

        // Сохранение пользователя с токеном
        $user->save();

        // Опционально, вы можете добавить дополнительные данные в ответ
        $response = [
            'token' => $user->token,
            'user' => $user,
        ];

        session()->forget('verification_code');

        return response()->json($response);
    }

    public function resendSMS(SendSmsRequest $request): JsonResponse
    {
        $this->authService->sendSMS($request->validated()['phone_number']);
        return response()->json(['message' => 'New SMS sent successfully']);
    }


}
