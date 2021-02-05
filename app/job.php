<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{
   protected $table = 'jobs';
    protected $guarded = [
        'id'    //
    ];
}
