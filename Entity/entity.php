<?php

namespace BlogPHP\Entity;

class Entity {

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
                if (method_exist($this, $method))
                {
                    $this->$method($value);
                }
        }
    }
}
