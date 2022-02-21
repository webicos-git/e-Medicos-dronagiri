<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sonography extends Model
{
    protected $table = 'sonographies';
    protected $fillable = ['name','description'];
}
