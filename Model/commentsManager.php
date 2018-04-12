<?php

namespace BlogPHP\Model;

require_once("Model/manager.php");
require_once("Entity/comment.php");

class commentManager extends Manager
{
    public function getComments($_post_id)
    {
        $db = $this->dbConnect();
    
        $comment = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comment->execute(array($_post_id));
                
        return $comment;
    }
                      
    public function getComment($_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, comment, post_id FROM comments WHERE id = ?');
        $req->execute(array($_id));
        $comment = $req->fetch();
    
        return $comment;
    }
                      
    public function addComment($_post_id, $_author, $_comment)
    {
        $db = $this->dbConnect();   
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?,?,?, NOW())');
        $comment = $req->execute(array($_post_id, $_author, $_comment));
    
        return $comment;
    }
                      
    public function editComment($_id, $_comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = ? WHERE id= ?');
        $comment = $req->execute(array($_comment, $_id));
    
        return $comment;
    }
                      
    public function deleteComment($_id, $_author, $_comment)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM comments WHERE comment');
        $affectedcomment = $comment->execute(array($_id, $_author, $_comment));
    }
    
    public function reportComment($_id, $_post_id, $_author, $_comment)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, post_id, comment, author FROM comments WHERE id= ?');
        $affectedcomment = $comment->execute(array($_id, $_post_id, $_author, $_comment));
    }
}