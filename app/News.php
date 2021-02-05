<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'News';
    protected $guarded = [
        'id'    //
    ];
    protected $dates = ['entried_at'];
   //
}
