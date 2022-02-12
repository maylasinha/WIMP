<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'position', 'pet_id', 'user_id'
    ];

    public function pet()
    {
        return $this->belongsTo('App\Models\Pet');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
