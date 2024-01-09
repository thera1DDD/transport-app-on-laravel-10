<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;

class OfferService extends Controller
{

    public function store($data): void
    {
        Offer::firstOrCreate($data);
    }
    public function update($data,Offer $offer): void
    {
        $offer->update($data);
    }


}
