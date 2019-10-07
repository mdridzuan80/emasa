<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $table = "att2000.userinfo";
    protected $fillable = ['badgenumber', 'ssn', 'name'];
    public $timestamps = false;
    protected $primaryKey = 'userid';
}
