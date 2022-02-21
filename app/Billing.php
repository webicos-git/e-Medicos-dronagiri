<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billings';

    public function Patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }

    public function Items()
    {
        return $this->hasMany('App\Billing_item');
    }
}
