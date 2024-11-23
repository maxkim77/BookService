<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{

    protected $fillable = [
       'user_id', 'book_id', 'review_title', 'review_category', 'review', 'share_id'
    ];
    

    // Review 모델은 User 모델과 관계가 있습니다.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function shares()
    {
        return $this->hasMany(Share::class, 'review_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'review_id', 'id');
    }


}
