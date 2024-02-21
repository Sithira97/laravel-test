<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'status',
        'published_date',
        'user_id',
        'category_id',
        'views',
    ];

    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at',
    //     'title',
    // ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
