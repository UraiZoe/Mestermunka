<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $fillable = ['salon_name', 'owner_id', 'image_name','short_information', 'information', 'location'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function events()
    {
        return $this->hasMany(Event::class, 'salon_id');
    }
}