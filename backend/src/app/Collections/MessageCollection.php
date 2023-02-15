<?php
  
namespace App\Collections;
use Illuminate\Validation\ValidationException;
use App\Collections\AbstractCustomCollection;
use App\Models\Custom\Message;

/** 
 * ** DEMO-LARAVEL **
 * Classe per collecion di messaggi
 * che estende la AbstractCustomCollection
 * e valida il tipo di dato
*/
class MessageCollection extends AbstractCustomCollection
{

    protected function validateItem($value)
    {
        if (!$value instanceof Message) 
        {
            throw ValidationException::withMessages(['Message Error' => 'Not an instance of Message']);
        }
    }

}
