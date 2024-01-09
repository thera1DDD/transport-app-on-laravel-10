<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routing extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['*'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'owners_id','id');
    }

    public function filterByRouteType($routeType)
    {
        return $this->select('id', 'name', 'description', 'price', 'status', 'from_place', 'to_place', 'start_time', 'end_time', 'load_type', 'load_size', 'owners_id', 'created_at')
            ->where('route_type', $routeType);
    }
}
