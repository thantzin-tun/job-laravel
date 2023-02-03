<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    //ASS
    public function getCityNameAttribute(){
            return Str::lower($this->name);
    }


    //MU
    // public function setNameAttribute($value) {
    //     $this->attributes['name'] = strtolower($value);
    // }

    protected $fillable = ['name'];

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
