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

    public function thoughts()                //korisnik ima više ideja
    {
        return $this->hasMany(Thought::class)->latest();
    }


    public function comments()                //korisnik ima više comments 
    {
        return $this->hasMany(Comment::class)->latest();
    }

   
    //follower_id=nas_id
    //user_id= followed users id
    public function followings()   //ljudi koje mi pratimo
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();   //morali smo navesti ovaj follower_user zbog toga što  ne moze automatski naci tu tablicu

    }

    public function followers()
    {

        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    //Za unfollow

    public function follows(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists(); //Koristi se lančano pozivanje metode followings() za dobivanje liste korisnika koje trenutni korisnik prati.
        // where provjerava je li ID korisnika kojeg provjeravamo jednak ID-u korisnika koji se provjerava u kolekciji pratitelja.
        //user_id se odnosi na stupac user_id u tablici follower_user. To je ID korisnika koji se prati.
        //$user->id je ID korisnika koji se provjerava da li ga trenutni korisnik prati ili ne.

    }

   

    public function likes()     
    {
        return $this->belongsToMany(Thought::class, 'thought_like')->withTimestamps();
    }


    public function likesThought(Thought $thought)     //    Ova metoda prima instancu modela Thought kao argument i provjerava je li korisnik lajkao tu misao ili ne.
    {
        return $this->likes()->where('thought_id', $thought->id)->exists();
    }


    public function getImageURL()          //za slike          
    {
        if ($this->image) {
            return url('storage/', $this->image);
        }
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->name))) . "?d=identicon";








        
    }

    
    // BLOKIRANJE!!!!!!!!!!!


    //ep 28, ovo je za block i unblock
    //blocker_id=nas_id
    //user_id= blocked users id
    public function blockings()   //ljudi koje mi blokiramo
    {
        return $this->belongsToMany(User::class, 'blocks_user', 'blocks_id', 'user_id')->withTimestamps();   //morali smo navesto ovaj follower_user zbog toga što  ne moze automatski naci tu tablicu

    }

    public function blockedUsers()
    {

        return $this->belongsToMany(User::class, 'blocks_user', 'user_id', 'blocks_id')->withTimestamps();
    }

    //Za unblock

    public function isBlocked(User $user)
    {
        return $this->blockings()->where('user_id', $user->id)->exists(); //Koristi se lančano pozivanje metode followings() za dobivanje liste korisnika koje trenutni korisnik prati.
        // where provjerava je li ID korisnika kojeg provjeravamo jednak ID-u korisnika koji se provjerava u kolekciji pratitelja.
        //user_id se odnosi na stupac user_id u tablici follower_user. To je ID korisnika koji se prati.
        //$user->id je ID korisnika koji se provjerava da li ga trenutni korisnik prati ili ne.

    }

    //Ovo je za followere kada stisnem slicicu

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


//Nije mi htjelo izbrisati usera nakon delete pa sam dodao ovo

protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            // Brisanje povezane slike
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        });
    }





}
