<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRegist extends Model
{
    protected $table = 'MstAdmin';
    protected $guarded = [
        'id'    //
    ];
}
