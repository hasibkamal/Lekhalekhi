<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';
    protected $fillable = [
        'id',
        'user_type',
        'name',
        'author_category_id',
        'user_email',
        'password',
        'user_hash',
        'user_status',
        'user_verification',
        'user_photo',
        'user_nid',
        'user_dob',
        'user_gender',
        'user_phone',
        'signature',
        'nationality',
        'country',
        'district',
        'thana',
        'post_code',
        'company_name',
        'years_of_experience',
        'designation',
        'highest_degree',
        'address',
        'remember_token',
        'login_token',
        'is_approved',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

}
