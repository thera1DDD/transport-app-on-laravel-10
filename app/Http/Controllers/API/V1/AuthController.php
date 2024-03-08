<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\SendSmsRequest;
use App\Http\Requests\API\Profile\ProfileRequest;
use App\Http\Requests\API\Profile\ReplyOfferRequest;
use App\Services\AuthService;
use App\Services\ProfileService;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
       return $this->authService->sendSMS($request->validated()['phone_number'],mt_rand(1000,9999));
    }

    public function verifySMS(SendSmsRequest $request): JsonResponse
    {
        $data = $request->validated();
        $verificationCode = session('verification_code.code');

        if (!$verificationCode || $verificationCode !== $data['code']) {
            return response()->json(['message' => 'Invalid verification code'], 401);
        }

        // Ваша логика успешной верификации, например, выдача токена
        $token = Auth::login(Auth::user());

        session()->forget('verification_code');

        return response()->json(['token' => $token]);
    }

    public function resendSMS(SendSmsRequest $request): JsonResponse
    {
        $this->authService->sendSMS($request->validated()['phone_number']);
        return response()->json(['message' => 'New SMS sent successfully']);
    }


}
