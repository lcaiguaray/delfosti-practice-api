<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'categories';

    protected $fillable = [
        'name',
        'article_ids'
    ];

    protected $hidden = [
        'article_ids'
    ];

    // Relationships
    public function articles()
    {
        return $this->belongsToMany(Article::class, null, 'category_ids', 'article_ids');
    }
}
