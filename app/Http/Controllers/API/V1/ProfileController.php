<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Profile\ProfileRequest;
use App\Http\Requests\API\Profile\ReplyOfferRequest;
use App\Services\ProfileService;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function show(Request $request): Application|\Illuminate\Http\Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return $this->profileService->show($request);
    }

    public function update(ProfileRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->profileService->update($data);
    }

    public function replyOffer(ReplyOfferRequest $request): JsonResponse
    {
        $data = $request->validated();
        return response()->json(['offer'=>$this->profileService->replyOffer($data)]);
    }
}
