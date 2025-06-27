<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'bedrooms', 'bathrooms','price' ,'capacity' ,'extras', 'image', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorite_properties')->withTimestamps();
}

}