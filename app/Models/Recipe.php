<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Recipe extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'author_id',
        'image_path',
        'yt_link'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
}
