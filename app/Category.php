<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'MstCategory';
    protected $guarded = [
        'id'    //
    ];
}
