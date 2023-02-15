<?php
namespace App\Collections;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

/**
 ** DEMO-LARAVEL **
 * Classe Astratta che estende la Collection di Laravel
 * che serve per avere delle collection tipizzate 
*/
abstract class AbstractCustomCollection extends Collection
{

    /**
     * Create a new collection.
     *
     * @param  mixed []  $items
     * @return void
     */
    public function __construct($items = [])
    {
        foreach ($items as $item)
        {
            $this->validateItem($item);
        }
        return parent::__construct($items);
    }

    public function push(...$value)
    {
        $this->validateItem(...$value);
        return parent::push(...$value);
    }
      
    abstract protected function validateItem($item);
}