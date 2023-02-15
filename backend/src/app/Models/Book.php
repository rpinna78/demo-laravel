<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chapter;
use App\Enums\BookPrivacyEnum;
use App\Enums\BookStatusEnum;

/** 
* ** DEMO-LARAVEL **
* Modello di dati presente in DB ( estendeo il model di Laravel)
* e usa il trait HasFactory
* mostra le relazioni presenti a livello di base dati
*/
class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','status','privacy'];

    protected $with = ['image'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }


    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    /**
     * Write code on Method
     *
     * @return response()
    */
    protected $casts = [
        'privacy' => BookPrivacyEnum::class,
        'status' => BookStatusEnum::class
    ];
}
