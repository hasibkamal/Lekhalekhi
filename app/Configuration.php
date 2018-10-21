<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configuration';
    protected $fillable = [
        'id',
        'caption_name',
        'value',
        'is_archive',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
