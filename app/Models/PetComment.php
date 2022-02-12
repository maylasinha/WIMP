<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'pet_id'
    ];

    public function pet()
    {
        return $this->belongsTo('App\Models\Pet');
    }
}
