<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->morphedByMany(User::class, 'imageable');
    }

    public function category()
    {
        return $this->morphedByMany(Category::class, 'imageable');
    }

    public function product()
    {
        return $this->morphedByMany(Product::class, 'imageable');
    }
}
