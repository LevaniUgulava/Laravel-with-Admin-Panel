<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newproduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'price'];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
