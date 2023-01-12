<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'articles';

    protected $fillable = [
        'name',
        'description',
        'status',
        'category_ids'
    ];

    protected $hidden = [
        'category_ids'
    ];

    // Relationships
    public function categories()
    {
        return $this->belongsToMany(Category::class, null, 'article_ids', 'category_ids');
    }
}
