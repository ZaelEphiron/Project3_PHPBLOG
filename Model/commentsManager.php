<?php

namespace BlogPHP\Model;

class CommentsManager extends Manager
{
    public function getComments($_post_id = null)
    {
        $db = $this->dbConnect();
        
        if($_post_id == null){
            $Comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, report FROM comments ORDER BY comment_date DESC');
            $Comments->execute();
        }else{
            $Comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, report FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
            $Comments->execute(array($_post_id));
        }
    
        return $Comments;
    }
                      
    public function getComment($_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, comment, post_id FROM comments WHERE id = ?');
        $req->execute(array($_id));
        $Comment = $req->fetch();
    
        return $Comment;
    }
                      
    public function addComment($_post_id, $_author, $_comment)
    {
        $db = $this->dbConnect();   
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?,?,?, NOW())');
        $Comment = $req->execute(array($_post_id, $_author, $_comment));
    
        return $Comment;
    }
                      
    public function editComment($_id, $_comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = ? WHERE id= ?');
        $Comment = $req->execute(array($_comment, $_id));
    
        return $Comment;
    }
                      
    public function deleteComment($_id)
    {
        $db = $this->dbConnect();
        $Comment = $db->prepare('DELETE FROM comments WHERE id= ?');
        $affectedComment = $Comment->execute(array($_id));
        
        return $affectedComment;
    }
    
    public function reportComment($_id)
    {
        $db = $this->dbConnect();
        $Comment = $db->prepare('UPDATE comments SET comments.report = report+1 WHERE comments.id = ?');
        $affectedComment = $Comment->execute(array($_id));
        
        return $affectedComment;
    }
    
    public function removeReport($_id)
    {
        $db = $this->dbConnect();
        $Comment = $db->prepare('DELETE report FROM comments WHERE id=?');
        $afectedComment = $Comment->execute(array($_id));
        
        return $affectedComment;
    }
}