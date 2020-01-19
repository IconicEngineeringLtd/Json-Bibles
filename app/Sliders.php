<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $fillable = ['image', 'thumbnail_small', 'header', 'content', 'header', 'position', 'privacy'];
}
