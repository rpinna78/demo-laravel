<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/** 
* ** DEMO-LARAVEL **
* Modello di dati presente in DB ( estendeo il model di Laravel)
* e usa il trait HasFactory
* mostra le relazioni presenti a livello di base dati
*/
class Media extends Model
{
    use HasFactory;

    protected $table = "media";
    protected $fillable = ["chapter_id","media_title"];
    
    public function mediable()
    {
        return $this->morphsTo();
    }
}
