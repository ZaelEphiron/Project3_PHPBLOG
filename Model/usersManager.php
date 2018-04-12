<?php

namespace BlogPHP\Model;

require_once("Model/manager.php");
require_once("Entity/users.php");

class UsersManager extends Manager {
    
    public verifId($_pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, password FROM users WHERE pseudo = ?');
        $user = $req->execute(array($_pseudo));
        
        return $user;
    }    
    
    public addUser($_id, $pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users (id, password, mail, role) VALUES(?,?,?,?');
        $comment = $req->execute(array($_id, $_pseudo, $_password, $_mail, $_role)); 
    }
        
    public deleteUser($_id, $pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE id, pseudo, password, mail, role FROM users');
        $user = $req->execute(array($_id, $_password, $_mail, $_role)); 
    }
    
    public getUser($_id, $pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, password, mail, role FROM users WHERE id = ? ORDER BY id DESC');
        $user->execute(array($_id, $pseudo, $_password, $_mail, $_role));
        return $user;
    }
        
    public getUsers($_id, $pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, pseudo, password, mail, role FROM users WHERE id = ? ORDER BY id DESC');
        $users->execute(array($_id, $pseudo, $password, $mail, $_role));        
        return $users;
    }        
} 
