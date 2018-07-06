<?php

namespace BlogPHP\Model;

class UsersManager extends Manager 
{
    public function verifId($_pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, password, role FROM users WHERE pseudo = ?');
        $req->execute(array($_pseudo));
        $user = $req->fetch();
        
        return $user;
    }    
    
    public function addUser($_pseudo, $_password, $_mail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users (pseudo, password, mail) VALUES(?,?,?)');
        $req->execute(array($_pseudo, $_password, $_mail)); 
        $userId = $db->lastInsertId();
        
        $reqUser = $db->query('SELECT id, pseudo, password, mail FROM users WHERE id = '.$UserId);
        $user = $reqUser->fetch();
        
        return $user;
    }
        
    public function deleteUser($_id, $_pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE id, pseudo, password, mail, role FROM users');
        $user = $req->execute(array($_id, $_pseudo, $_password, $_mail, $_role)); 
    
        return $user;
    }
    
    public function getUser($_id, $_pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $user = $db->prepare('SELECT id, pseudo, password, mail, role FROM users WHERE id = ? ORDER BY id DESC');
        $user->execute(array($_id, $_pseudo, $_password, $_mail, $_role));
        
        return $user;
    }
        
    public function getUsers()
    {
        $db = $this->dbConnect();
        
        $users = $db->prepare('SELECT id, pseudo, password, mail, role FROM users ORDER BY id DESC');
        $users->execute();        
        
        return $users;
    }
} 
