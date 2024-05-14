<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\MainDIsplay\FilterRequest;
use App\Http\Requests\API\MainDIsplay\SendOfferRequest;
use App\Models\Routing;
use App\Services\RoutingService;
use Illuminate\Http\JsonResponse;

class MainDisplayController extends Controller
{

    protected RoutingService $routingService;

    public function __construct(RoutingService $routingService)
    {
        $this->routingService = $routingService;
    }
    public function getRoutes(): JsonResponse {
        $carrierRoutes = (new Routing)->filterByRouteType('carrier')->with('user')->get();
        $senderRoutes = (new Routing)->filterByRouteType('sender')->with('user')->get();//check
        return response()->json(['carrier'=>$carrierRoutes,'sender'=>$senderRoutes]);
    }

    public function filterRoutes(FilterRequest $request): JsonResponse {
        $data = $request->validated();
        return $this->routingService->filter($data);
    }
    public function sendOffer(SendOfferRequest $request): JsonResponse
    {
        //check commit
        $data = $request->validated();
        return $this->routingService->sendOfferToRoute($data);
    }
}
