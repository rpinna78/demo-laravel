<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

/** 
* ** DEMO-LARAVEL **
* Modello di dati presente in DB ( estendeo il model di Laravel)
* e usa il trait HasFactory
* mostra le relazioni presenti a livello di base dati
*/
class Chapter extends Model
{
    use HasFactory;
    // gli aggiornamenti sui capitoli modificano la data di aggiornamento anche nel libro che lo contiene
    protected $touches = ['book'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }


    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
