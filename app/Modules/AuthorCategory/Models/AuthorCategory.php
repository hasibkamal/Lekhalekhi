<?php

namespace App\Modules\AuthorCategory\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorCategory extends Model {

    protected $table = 'author_category';
    protected $fillable = [
    	'id',
    	'category_name',
    	'feature_image',
    	'menu_status',
    	'status',
    	'is_archive',
    	'created_at',
    	'created_by',
    	'updated_at',
    	'updated_by'
    ];

}
