<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_of_measure'
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
