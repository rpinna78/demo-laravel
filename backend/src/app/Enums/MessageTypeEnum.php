<?php
  
namespace App\Enums;

/** 
 * ** DEMO-LARAVEL **
 * Enum che definisce i valori possibile per i tipi di messaggio che restituisce il  BE
 */
enum MessageTypeEnum:string {
    case SUCCESS='success';
    case INFO='info';
    case WARN='warn';
    case ERROR='error';
}
