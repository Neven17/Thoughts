<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function thoughts()              
    {
        return $this->hasMany(Thought::class)->latest();
    }


    public function comments()               
    {
        return $this->hasMany(Comment::class)->latest();
    }

   
   
    public function followings() 
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();  

    }

    public function followers()
    {

        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    //Za unfollow

    public function follows(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
      

    }

   

    public function likes()     
    {
        return $this->belongsToMany(Thought::class, 'thought_like')->withTimestamps();
    }


    public function likesThought(Thought $thought)   
    {
        return $this->likes()->where('thought_id', $thought->id)->exists();
    }


        
    public function likesComment()
    {
        return $this->belongsToMany(Comment::class, 'comment_like')->withTimestamps();
    }

  
    public function isLiked(Comment $comment)   
    {
        return $this->likesComment->where('comment_id', $comment->id)->withTimestamps();
    }

  


    public function getImageURL()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->name))) . "?d=identicon";
    }
    

    
    //Za block


    public function blockings()  
    {
        return $this->belongsToMany(User::class, 'blocks_user', 'blocks_id', 'user_id')->withTimestamps();  

    }

    public function blockedUsers()
    {

        return $this->belongsToMany(User::class, 'blocks_user', 'user_id', 'blocks_id')->withTimestamps();
    }

    //Za unblock

    public function isBlocked(User $user)
    {
        return $this->blockings()->where('user_id', $user->id)->exists(); 
      

    }

   

    public function isBlockedByOrBlocking(User $user)
    {
        return $this->blockings()->where('user_id', $user->id)->exists() || 
               $this->blockedUsers()->where('blocks_id', $user->id)->exists();
    }




    public function followSuggestions()
{
    $currentUser = auth()->user();
    $followingsUserIDs = $this->followings()->pluck('id');
    $blockedUserIDs = $this->blockings()->pluck('id');
    $blockedByUsers=$this->blockedUsers()->pluck('id');

    return self::whereNotIn('id', $followingsUserIDs)
        ->whereNotIn('id', $blockedUserIDs)
        ->whereNotIn('id', $blockedByUsers)
        ->where('id', '!=', $currentUser->id)
        ->inRandomOrder()
        ->limit(5)
        ->get();
}




protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
           
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        });
    }





}
