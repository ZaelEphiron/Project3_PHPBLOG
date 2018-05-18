<?php
namespace BlogPHP\Entity;

use BlogPHP\Entity\Entity;

class Post extends Entity
{
    // Attributs
    // Privés
    private $_id; 
    private $_title;
    private $_content;
    private $_creationDate;
    
    // Getters
    
    public function id()
    {
         return $this->_id;   
    }
        
    public function title()
    {
        return $this->_title;
    }
        
    public function content()
    {
        return $this->_content;
    }
    
    public function creationDate()
    {
        return $this->_creationDate;
    }
    
    // Setters
    
    public function setId($id)
    {
        $id = (int) $id;
        
        if ($id > 0)
        {
            $this->_id = $id;
        }
    }
    
    public function setTitle($title)
    {
        if (is_string($title))
        {
            $this->_title = $title;
        }
    }
    
    public function setContent($content)
    {
        if (is_string($content))
        {
            $this->_content = $content;
        }
    }
    
    public function setCreationDate($creationDate)
    {
        if (is_string($creationDate))
        {
            $this->_creationDate = $creationDate;
        }
    }
}
 