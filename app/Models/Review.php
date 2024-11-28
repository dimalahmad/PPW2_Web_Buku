<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'user_id',
        'review',
        'tags',
    ];
    protected $casts = [
        'tags' => 'array',
    ];
    
    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}