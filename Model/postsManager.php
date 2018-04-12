<?php

namespace BlogPHP\Model;

require_once("Model/manager.php");
require("Entity/post.php");

use Blogphp\Model\Manager;

class postManager extends Manager 
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
    $post = $req->fetch();
    
    return $post;
}

public function addPost($_id, $_title, $_content)
{
    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO posts (id, title, content, creation_date) VALUES(?,?,?, NOW())');
    $comment = $req->execute(array($_id, $_author, $_comment));
    
    return $comment;
}


public function editPost($_id, $_title, $_content)
{
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE post SET id, title, content');
    $post = $req->execute(array($_id, $_title, $_content));
    
    return $post;
}

public function deletePost($_id, $_title, $_content)
{
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM posts WHERE post');
    $req->execute(array($_id, $_title, $_content));
}
}