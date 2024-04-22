<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;

class UserService extends Controller
{

    public function store($data): void
    {
        User::firstOrCreate($data);
    }
    public function update($data,User $user): void
    {
        $user->update($data);
    }
}
