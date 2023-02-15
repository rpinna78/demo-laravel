<?php
  
namespace App\Helpers;

/** 
* ** DEMO-LARAVEL **
* Classe di helper generica che comprende:
* - Metodo che genera dellle combo a partire da values e labels
*/
class UtilHelper
{
    
    static public function makeCombo($values,$labels=null) 
    {
        if(!$labels){
            $labels = $values; 
        }
        $collection = collect($values);
        $collection->transform(function ($item, $key) use ($labels) {
            return ['value'=>$item,'label'=>$labels[$key]];
        });
        return ($collection->all());
    }
    
}
