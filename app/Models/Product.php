<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'orders', 'product_id', 'user_id')
            ->withPivot(['status', 'delivered_at'])
            ->withTimestamps();
    }
}
