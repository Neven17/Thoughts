<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;



    protected $fillable = [
        'user_id',
        'thought_id',
        'content',

      
    ];

    public function user()
    {
        return $this->belongsTo(User::class);          
    }

    public function thought()
    {
        return $this->belongsTo(Thought::class);           
    }

    public function likesComment()
    {
        return $this->belongsToMany(User::class, 'comment_like')->withTimestamps();

    }
  

}
