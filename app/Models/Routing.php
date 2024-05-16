<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Routing extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts =
        [
            'load_width'=>'integer',
            'load_length'=>'integer',
            'load_height' =>'integer'
        ];

    protected $fillable = ['name','description','route_type','from_place','to_place','load_type','load_size','status','price','start_time','end_time','owners_id','load_width','load_length','load_height'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'owners_id','id');
    }

    public function filterByRouteType($routeType)
    {
        return $this->select('id', 'name', 'description', 'price', 'status', 'from_place', 'to_place', 'start_time', 'end_time','route_type', 'load_type', 'load_size', 'owners_id', 'created_at','load_width','load_length','load_height')
            ->where('route_type', $routeType)
            ->where('end_time', '>', now()->toDateTimeString())
            ->get(); // Сравниваем end_time с текущим временем в строковом формате
    }
}
