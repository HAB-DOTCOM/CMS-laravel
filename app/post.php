<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    //
   use SoftDeletes;
     protected $fillable = [
        'title','description','content','image','published_at','catagory_id','user_id'
    ];

    public function catagory()
    {
        return $this->belongsTo(catagory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function scopeSearched($query)
    {
        $search = request()->query('search');
        if(!$search){
            return $query;
        }

        return $query->where('title','LIKE',"%search%");
    }
}

