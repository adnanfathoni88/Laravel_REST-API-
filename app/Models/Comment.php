<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = [
        'post_id',
        'author_id',
        'comment'
    ];

    public function comentator()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
