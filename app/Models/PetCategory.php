<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pets()
    {
        return $this->hasMany('App\Models\Pet');
    }
}
