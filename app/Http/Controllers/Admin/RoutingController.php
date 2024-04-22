<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Routing\StoreRequest;
use App\Http\Requests\Routing\UpdateRequest;
use App\Models\Routing;
use App\Models\User;
use App\Services\RoutingService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LogoutResponse;

class RoutingController extends Controller
{

    /**
     * The guard implementation.
     *
     * @var StatefulGuard
     */
    protected StatefulGuard $guard;

    /**
     * Create a new controller instance.
     *
     * @param StatefulGuard $guard
     * @return void
     */
    protected $routingService;

    public function __construct(RoutingService $routingService)
    {
        $this->routingService = $routingService;
    }
    public function destroy(Routing $routing): \Illuminate\Http\RedirectResponse
    {
        $routing->delete();
        return redirect()->route('routing.index')->with('error','Удаленно');
    }

    public function index(): \Illuminate\Contracts\View\View|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('routings.index')->with(['routings' => Routing::with('user')->paginate(3)]);
    }

    public function create(): \Illuminate\Contracts\View\View|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('routings.create')->with(['users'=>User::select('id','name','route_role')->get()]);
    }

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $this->routingService->store($data);
        return redirect()->route('routing.index')->with('success','Успешно созданно');
    }

    public function update(UpdateRequest $request, Routing $routing): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $this->routingService->update($data,$routing);
        return redirect()->route('routing.index')->with('success','Обновленно');
    }

    public function edit(Routing $routing): \Illuminate\Contracts\View\View|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::select('id','name','route_role')->get();
        return view('routings.edit',compact(['routing','users']));
    }
}
