<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'title', 'author', 'description', 'thumbnail', 'extraLarge', 'category', 'publisher', 'publishedDate', 'price', 'buyLink'
    ];

    

    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id', 'id');
    }

}
