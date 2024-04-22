<?php

namespace App\Services;

use App\Http\Controllers\Admin\RoutingController;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\MainDisplayResource\OfferResource;
use App\Models\Offer;
use App\Models\Routing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class RoutingService extends Controller
{

    public function store($data){
        Routing::firstOrCreate($data);
    }
    public function update($data,Routing $routing){
        $routing->update($data);
    }

    public function filter($data): JsonResponse {

        $query = Routing::with('user')->where('route_type', $data['route_type']);
        if (isset($data['start_time']) && $data['start_time'] !== '') {
            $query->where(function ($q) use ($data) {
                $q->whereDate('start_time', $data['start_time'])
                    ->orWhereDate('end_time', $data['start_time']);
            });
        }
        if (isset($data['from_place']) && $data['from_place'] !== '') {
            $query->where('from_place', 'LIKE', '%' . $data['from_place'] . '%');
        }

        if (isset($data['to_place']) && $data['to_place'] !== '') {
            $query->where('to_place', 'LIKE', '%' . $data['to_place'] . '%');
        }

        if (isset($data['end_time']) && $data['end_time'] !== '') {
            $query->whereDate('end_time', $data['end_time']);
        }
        return response()->json(['data'=>$query->get()]);
    }

    public function sendOfferToRoute($data): JsonResponse {
        $existingOffer = Offer::query()->where('requested_users_id',$data['requested_users_id'])
                                       ->where('routings_id',$data['routings_id'])
                                       ->exists();
        if($existingOffer){
            return response()->json(['success'=>false,'message'=>'offer already exist'],409);
        }
        else{
            $result = Offer::create($data);
            return response()->json(['success'=>true,'data'=>new OfferResource($result)]);
        }
    }
}
