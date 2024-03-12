<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Routing\StoreRequest;
use App\Models\Routing;
use Illuminate\Http\JsonResponse;

class PersonalRoutesController extends Controller
{
    public function getMyRoutes(int $users_id)
    {
        return Routing::where('owners_id',$users_id)->paginate(4);
    }

    public function addRoute(StoreRequest $request): JsonResponse
    {   $data =  $request->validated();
        $route = Routing::create($data);
        return response()->json(['result' => $route]);
    }
}
