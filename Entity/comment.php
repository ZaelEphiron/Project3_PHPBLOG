<?php

namespace BlogPHP\Entity;

class Comment extends Entity
{
    // Attributs
    // Privés
    private $_id; 
    private $_author;
    private $_comment;
    private $_commentDate;
    private $_postId;
    
    // Getters
    
    public function id()
    {
        return $this->_id;
    }
    
    public function author()
    {
        return $this->_author;
    }
    
    public function comment()
    {
        return $this->_comment;
    }
        
    public function commentDate()
    {
        return $this->_commentDate;
    }
         
    public function postId()
    {
        return $this->_postId;
    }
    
    // Setters
    
    public function setId($id)
    {
        $id = (int) $id;
        
        if ($id >0)
        {
            $this->_id = $id;
        }
    }
        
    public function setAuthor($author)
    {
        if (is_string($author))
        {
            $this->_author = $author;
        }
    }
        
    public function setComment($comment)
    {
        if (is_string($comment))
        {
            $this->_comment = $comment;
        }
    }
    
    public function setCommentDate($commentDate)
    {
        if (is_string($commentDate))
        {
            $this->_commentDate = $commentDate;
        }
    }
        
    public function setPostId($postId)
    {
        $postId = (int) $postId;
        
        if ($postId >0)
        {
            $this->_postId = $postId;
        }
    }
}
