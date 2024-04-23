<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Routing\StoreRequest;
use App\Http\Requests\Routing\UpdateRequest;
use App\Http\Resources\API\MainDisplayResource\PersonalRouteResource;
use App\Models\Routing;
use App\Services\RoutingService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class PersonalRoutesController extends Controller
{

    protected $routingService;

    public function __construct(RoutingService $routingService)
    {
        $this->routingService = $routingService;
    }
    public function getMyRoutes(int $users_id): Collection|array
    {
        return Routing::with('user')->where('owners_id',$users_id)->get();
    }

    public function addRoute(StoreRequest $request): JsonResponse
    {
        $route = Routing::create($request->validated());
        return response()->json(['result' => new PersonalRouteResource($route)]);
    }

    public function updateRoute(UpdateRequest $request): JsonResponse
    {
        $currentRoute = Routing::findOrFail($request->id);
        $this->routingService->update($request->validated(),$currentRoute);
        return response()->json($currentRoute);
    }
}
