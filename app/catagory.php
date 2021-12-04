<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catagory extends Model
{
    //
    protected $fillable = [
        'name'
    ];
    public function posts()
    {
        return $this->hasMany(post::class);
    }
}
