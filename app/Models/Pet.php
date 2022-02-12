<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gender', 'size', 'breed', 'description', 'slug', 'lost_at', 'found_at', 'pet_category_id', 'user_id'
    ];

    public function pet_images()
    {
        return $this->hasMany('App\Models\PetImage');
    }

    public function pet_comments()
    {
        return $this->hasMany('App\Models\PetComment');
    }

    public function pet_category()
    {
        return $this->belongsTo('App\Models\PetCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Cascade delete
    public static function boot() {
        parent::boot();

        static::deleting(function($pet) {
             $pet->pet_images()->delete();
             $pet->pet_comments()->delete();
        });
    }
}
