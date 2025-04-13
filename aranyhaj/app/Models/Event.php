<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'location', 'salon_id', 'owner_id', 'image_name', 'short_information', 'information', 'posted_time', 'starts_at', 'created_at', 'updated_at'];


    public function interactions()
    {
        return $this->hasMany(Interaction::class, 'event_id');
    }

    public function likes()
    {
        return $this->hasMany(Interaction::class, 'event_id')->where('liked', 1);
    }

    public function participants()
    {
        return $this->hasMany(Interaction::class, 'event_id')->where('participation', 1);
    }
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}