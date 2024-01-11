<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreRequest;
use App\Http\Requests\Offer\UpdateRequest;
use App\Http\Requests\Offer\UserRequest;
use App\Models\Offer;
use App\Models\Routing;
use App\Models\User;
use App\Services\OfferService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LogoutResponse;

class OfferController extends Controller
{
    protected $offerService;

    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }
    public function destroy(Offer $offer): RedirectResponse
    {
        $offer->delete();
        return redirect()->route('offer.index')->with('error','Удаленно');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('offers.index')->with(['offers' => Offer::with('requested_user','route')->paginate(3)]);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('offers.create')->with(['users' => User::select('id','name','route_role')->get(),'routings' => Routing::select('id','name')->get()]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->offerService->store($data);
        return redirect()->route('offer.index')->with('success','Успешно созданно');
    }

    public function update(UpdateRequest $request, Offer $offer): RedirectResponse
    {
        $data = $request->validated();
        $this->offerService->update($data,$offer);
        return redirect()->route('offer.index')->with('success','Обновленно');
    }

    public function edit(Offer $offer): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::select('id','name','route_role')->get();
        $routings = Routing::select('id','name')->get();
        return view('offers.edit',compact(['offer','users','routings']));
    }
}
