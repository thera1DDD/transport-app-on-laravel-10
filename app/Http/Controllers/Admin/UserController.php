<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Models\Routing;
use App\Services\UserService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('user.index')->with('error','Удаленно');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('users.index')->with(['users' => User::paginate(3)]);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('users/main_images', 'public');
            $data['main_image'] = asset(Storage::disk('public')->url($path));
        }
        $this->userService->store($data);
        return redirect()->route('user.index')->with('success','Успешно созданно');
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('users/main_images', 'public');
            $data['main_image'] = asset(Storage::disk('public')->url($path));
        }
        $this->userService->update($data,$user);
        return redirect()->route('user.index')->with('success','Обновленно');
    }

    public function edit(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::select('id','name','route_role')->get();
        $routings = Routing::select('id','name')->get();
        return view('users.edit',compact(['user','users','routings']));
    }
}
