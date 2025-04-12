<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'date',
        'time',
        'number',
        'status',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function getFormattedTimeAttribute()
    {
        return $this->time ? Carbon::parse($this->time)->format('H:i') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
