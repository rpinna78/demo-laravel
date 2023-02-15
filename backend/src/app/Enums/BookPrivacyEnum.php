<?php
  
namespace App\Enums;
 
/** 
 * ** DEMO-LARAVEL **
 * Enum che definisce i valori possibile per il tipo di privacy di un libro
 */
enum BookPrivacyEnum:string {
    case PUBLIC='public';
    case PRIVATE='private';
    case PASSWORD='password';
}