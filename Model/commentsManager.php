<?php

namespace BlogPHP\Model;

class CommentsManager extends Manager
{
    public function getComments($_post_id = null)
    {
        $db = $this->dbConnect();
        
        if($_post_id == null){
            $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, report FROM comments ORDER BY report DESC');
            $comments->execute();
        }else{
            $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, report FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
            $comments->execute(array($_post_id));
        }
    
        return $comments;
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
                      
    public function deleteComment($_id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM comments WHERE id= ?');
        $affectedComment = $comment->execute(array($_id));
        
        return $affectedComment;
    }
    
    public function reportComment($_id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE comments SET comments.report = report+1 WHERE comments.id = ?');
        $affectedComment = $comment->execute(array($_id));
        
        return $affectedComment;
    }
    
    public function removeReport($_id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE comments SET comments.report = 0 WHERE comments.id=?');
        $afectedComment = $comment->execute(array($_id));
        
        return $affectedComment;
    }
}