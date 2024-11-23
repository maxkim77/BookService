<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
class Share extends Model
{
    use HasFactory;

    protected $fillable = ['share', 'review_id'];

    public function reviews()
    {
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }
}
