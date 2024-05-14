<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Routing;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\LogoutResponse;

class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('home.index');
    }

    public function routesChart(): \Illuminate\Http\JsonResponse
    {
        $data = Offer::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as count"))
            ->where('status', 'completed')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();

        return response()->json($data);
    }
}
