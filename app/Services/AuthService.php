<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\VerifySmsRequest;
use App\Models\Offer;
use App\Models\User;
use http\Env\Request;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function Symfony\Component\String\u;


class AuthService extends Controller
{

    public function verifyCode($data)
    {
        $user = User::where('id',$data['users_id'])->first();
        if($user){
            if($user->verification_code == $data['verification_code']){
                $token = Str::random(60);
                $user->remember_token = $token;
                $user->phone_verified_at = now();
                $user->save();
                return response()->json(['user'=>$user,'token'=>$token]);
            }
            else{
                return response()->json(['fail'=>'Неправильный код']);
            }
        }
        return response()->json(['error'=>'user does not exist'],404);
    }

    public function sendSMS($data, $code): JsonResponse
    {
        try {
//                // Отправляем SMS через API
//                $response = Http::post(env('SMS_API') .'/sms/send', [
//                    'user' => env('SMS_LOGIN'),
//                    'pass' => env('SMS_PASSWORD'),
//                    'to' => $data['phone_number'],
//                    'txt' => 'Ваш код для авторизации: '.$code,
//                    'from' => 'Perevozki',
//                ]);
                // Добавление пользователя
                $userData = $this->postUser($data['phone_number'],$code);
                return response()->json([
                    'success' => true,
                    'data' => [
//                        'green_sms_data' => $response,
                        'code' => $code,
                        'user' => $userData,
                    ],
                ]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    public function postUser($phone, $code)
    {
        $user = User::where('phone_number',$phone)->first();
        if(isset($user)){
            $user->verification_code = $code;
            $user->save();
            return $user;
        }
        else{
            return User::firstOrCreate
            (
                [
                    'phone_number'=>$phone,
                    'verification_code'=>$code
                ]
            );
        }
    }

    public function checkToken($data): JsonResponse
    {
        $user = User::query()->whereNotNull('phone_verified_at')
                             ->where('id',$data['users_id'])
                             ->where('remember_token',$data['remember_token'])
                             ->exists();
        return response()->json(['user' => $user]);
    }

    public function logout($users_id): JsonResponse
    {
        try {
            User::query()->where('id', $users_id)->update(['remember_token' => null, 'phone_verified_at' => null]);
            return response()->json(['success' => true, 'message' => 'Token cleared successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
