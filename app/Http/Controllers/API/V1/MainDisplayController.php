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
        $carrierRoutes = (new Routing)->filterByRouteType('carrier')->paginate(4);
        $senderRoutes = (new Routing)->filterByRouteType('sender')->paginate(4);
        return response()->json(['carrier'=>$carrierRoutes,'sender'=>$senderRoutes]);
    }

    public function filterRoutes(FilterRequest $request): JsonResponse {
        $data = $request->validated();
        return $this->routingService->filter($data);
    }
    public function sendOffer(SendOfferRequest $request): JsonResponse {
        $data = $request->validated();
        return $this->routingService->sendOfferToRoute($data);
    }
}
