<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function map()
    {
        return $this->belongsTo('App\Map');
    }
}
