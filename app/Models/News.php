<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'author_name', 'author_id', 'display', 'published_at'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at', 'published_at'];
}
