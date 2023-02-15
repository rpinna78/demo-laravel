<?php

namespace App\Models\Custom;

use App\Enums\MessageTypeEnum;
/** 
* ** DEMO-LARAVEL **
* Nodello custom che defnisce il modello dei dati del messaggio
* e implementa la JsonSerializable per generare un json di riposta 
*/
class Message implements \JsonSerializable
{
    private MessageTypeEnum $severity;
    private string $text;
    private string $detail;

    function __construct(MessageTypeEnum $severity, string $summary, string $detail = null )
    {
        $this->severity = $severity;
        $this->summary = $summary;
        if($detail)
        {
            $this->detail = $detail;
        }
    }

    function __get($name)
    {
        return $this->$name;
    }
    
    public function jsonSerialize()
    {
        $detail=(isset($this->detail))?['detail'=>$this->detail]:[];
        return array_merge($detail,[
            'severity' => $this->severity,
            'summary' => $this->summary
        ]);
    }
}
