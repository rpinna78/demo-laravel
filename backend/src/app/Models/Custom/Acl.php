<?php

namespace App\Models\Custom;
/** 
* ** DEMO-LARAVEL **
* Nodello custom che defnisce il modello dei dati della ACL
* e implementa la JsonSerializable per generare un json di riposta 
*/
class Acl implements \JsonSerializable
{
    private bool $create = false;
    private bool $read = false;
    private bool $update = false;
    private bool $delete = false;
    

    function __get(string $name)
    {
        return $this->$name;
    }


    function __set(string $name , bool $value)
    {
        $this->$name = $value;
    }
    
    public function jsonSerialize()
    {
        return [
            'create' => $this->create,
            'read' => $this->read,
            'update' => $this->update,
            'delete' => $this->delete
        ];
    }
}
