<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

/** 
* ** DEMO-LARAVEL **
* Modello di dati presente in DB ( estendeo il model di Laravel)
* e usa il trait HasFactory
* mostra le relazioni presenti a livello di base dati
*/
class Image extends Model
{
    use HasFactory;

    public function media(){
         return $this->morphMany(Media::class,'mediable');
    }
}
