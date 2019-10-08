<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkinout extends Model
{
    protected $table = "att2000.checkinout";
    public $timestamps = false;
    protected $primaryKey = 'userid';
}
