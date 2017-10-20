<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = [
        'uid', 'parentid', 'title','content','source','review'
    ];
}
