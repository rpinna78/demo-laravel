<?php
  
namespace App\Enums;
 
/** 
 * ** DEMO-LARAVEL **
 * Enum che definisce i valori possibile per lo stato di un libro
 */
enum BookStatusEnum:string {
    case DRAFT='draft';
    case SAVED='saved';
    case HIDDEN='hidden';
}