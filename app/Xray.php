<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xray extends Model
{
    protected $table = 'xrays';
    protected $fillable = ['name','description'];
}
