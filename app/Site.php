<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'MstSite';
    protected $guarded = [
        'id'    //
    ];
}