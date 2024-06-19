<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    use HasFactory;

 protected $with= ['user:id,name,image','comments.user:id,name,image'];    // stavio sam user zbog toga da smanjim queryije comments user- na comm ce se koristi user relacija
//id i name sam dodao pošto na pocetnoj stranici nam je potrebno da kada selecta usere treba naci samo po id i name

protected $withCount=['likes'];   //Dodano da mi prikaze likes i smanji kolicinu querija

    protected $fillable = [
        'user_id',
        'content',

      
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);      
    }

    public function user()
    {
        return $this->belongsTo(User::class);           
    }

    //dohvacamo sve lajkove
    //da smk imali tablicu thought_user ne bi morali nista definirati, ali posto imamo thought_like ond moramo nadodati tablicu dole
    public function likes()     //ep33 likes
    {
        return $this->belongsToMany(User::class,'thought_like')->withTimestamps();

    }


    //EP 45 SCOPE , uvijek moraju pocinjati s scope

    public function scopeSearch($query, $search='')          // $search je definiran zato sto nemamo http zahtjev, nego automatski pretrazujemo
    {
       $query ->where('content', 'like', '%' . $search . '%');     //trazi se argument koji pretrazujemo te s kim usporedujemo
                
    }

    

    



    

}
