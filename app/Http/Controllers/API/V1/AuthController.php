<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\CheckTokenRequest;
use App\Http\Requests\API\Auth\SendSmsRequest;
use App\Http\Requests\API\Auth\VerifySmsRequest;
use App\Http\Requests\API\Profile\ProfileRequest;
use App\Http\Requests\API\Profile\ReplyOfferRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ProfileService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
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

    public function verifyCode(VerifySmsRequest $request)
    {
        $data = $request->validated();
        return $this->authService->verifyCode($data);
    }
    public function sendSMS(SendSmsRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->authService->sendSMS($data,mt_rand(1000,9999));
    }

//    public function postUser(VerifySmsRequest $request): JsonResponse
//    {
//        $data = $request->validated();
//        return $this->authService->postUser($data);
//    }

    public function checkToken(CheckTokenRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->authService->checkToken($data);
    }

    public function logout(Request $request): JsonResponse
    {
       return $this->authService->logout($request->users_id);
    }
}
