<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\LogoutResponse;

class ProfileController extends Controller
{

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('profile.index');
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('users/main_images', 'public');
            $data['main_image'] = asset(Storage::disk('public')->url($path));
        }

        auth()->user()->update($data);

        return redirect()->route('profile.index')->with('success', 'Данные успешно обновлены');
    }

}
