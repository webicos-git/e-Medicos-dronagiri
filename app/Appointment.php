<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    public $dates = [ 'date'];


    public function Patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }
}
