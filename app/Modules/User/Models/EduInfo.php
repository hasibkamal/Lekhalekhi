<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class EduInfo extends Model {

    protected $table = 'educational_info';
    protected $fillable = [
        'id',
        'user_id',
        'institute',
        'degree',
        'passing_year',
        'cgpa',
        'out_of',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

}
