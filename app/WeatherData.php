<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    protected $fillable=[
        'id',
        'upozila',
        'date',
        'short_description',
        'long_description',
        'source'
    ];
    
    protected $table="weather_data";
}
