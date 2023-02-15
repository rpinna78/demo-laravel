<?php
  
namespace App\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

use App\Models\Custom\Message;
use App\Enums\MessageTypeEnum;
use App\Collections\MessageCollection;

/** 
* ** DEMO-LARAVEL **
* Classe di helper che aiuta a costruire le risposte del BE
* e implementa la JsonSerializable per generare un json di riposta 
* secondo le esigenze 
*/
class ResponseJsonHelper implements \JsonSerializable
{
    // Oggetto di risposta con i dati (singolo o multiplo)
    private mixed $content; 
    // Oggetto con lo stato boolean della risposta
    private bool $status;
    // Array con i messaggi con il tipo e il testo dei messaggi  
    private MessageCollection $messages;

    function __construct()
    {
        $this->status = false;
        $this->messages = new MessageCollection([]);
    }

    public function __set(string $name, mixed $value) 
    {
        if($name!='messages')
        {
            $this->$name = $value;
        }else
        {
            $this->messages = new MessageCollection([]);
            $this->addMessages($value);
        }
    }
    
    public function addMessages($messages, bool $errorDefault=false)
    {
        foreach ($messages as $item)
        {
            $this->addMessage($item,$errorDefault);
        }
    }

    private function addMessage(mixed $value, bool $error) 
    { 
        if($value instanceof Message)
        {
            return $this->addMessageFromMessage($value);
        }else
        {
            $this->addMessageFromParams($value,(!$error)?MessageTypeEnum::SUCCESS:MessageTypeEnum::ERROR);
        }
    }

    private function addMessageFromParams(string $text, MessageTypeEnum $type) 
    { 
        $this->messages->push(new Message($type,$text));
    }

    private function addMessageFromMessage(Message $message) 
    { 
        $this->messages->push($message);
    }
    
    public function jsonSerialize()
    {
        $results = [
            'status'=>$this->status, 
            'messages'=>$this->messages
        ];
        if(isset($this->content)){
            $results['content'] = $this->content;
        }
        return $results;
    }
}
