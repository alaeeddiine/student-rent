<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['property_id', 'student_id', 'name', 'contact', 'tour_date', 'status'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

}
