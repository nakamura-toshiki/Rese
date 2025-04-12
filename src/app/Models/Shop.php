<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'category_id',
        'name',
        'description',
        'image',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function liked()
    {
        return Like::where(['shop_id' => $this->id, 'user_id' => Auth::id()])->exists();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
