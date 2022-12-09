<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmers extends Model
{
    protected $fillable=[
        'id',
        'name',
        'email',
        'upozilla',
        'nidNo',
        'phone',
        'age',
        'crop_type',
        'amount_of_land',
        'lat',
        'long'
    ];
}
