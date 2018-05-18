<?php

namespace BlogPHP\Model;

class PostsManager extends Manager 
{   
    
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date_fr DESC LIMIT 0,5');
    
        return $req;
    }

    public function getPost($_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($_id));
        $Post = $req->fetch();
    
        return $Post;
    }

    public function addPost($_title, $_content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, content, creation_date) VALUES(?,?, NOW())');
        $Post = $req->execute(array($_title, $_content));
    
        return $Post;
    }


    public function editPost($_id, $_title, $_content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id= ?');
        $Post = $req->execute(array($_title, $_content, $_id));
        
        return $Post;
    }

    public function deletePost($_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $Post = $req->execute(array($_id));
    }
}