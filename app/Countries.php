<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    protected $fillable = [
    	'id',
    	'country_code',
    	'country_name'
    ];
}
