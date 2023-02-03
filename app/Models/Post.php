<?php

namespace App\Models;

use App\Models\City;
use App\Models\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        "title","company_name","salary","logo","job_deadline","description","category_id","city_id","address","applicant",'level_id'
    ];

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
