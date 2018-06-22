<?php

namespace BlogPHP\Model;

class UsersManager extends Manager 
{
    public function verifId($_pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, password, role FROM users WHERE pseudo = ?');
        $req->execute(array($_pseudo));
        $User = $req->fetch();
        
        return $User;
    }    
    
    public function addUser($_pseudo, $_password, $_mail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users (pseudo, password, mail) VALUES(?,?,?)');
        $req->execute(array($_pseudo, $_password, $_mail)); 
        $UserId = $db->lastInsertId();
        
        $reqUser = $db->query('SELECT id, pseudo, password, mail FROM users WHERE id = '.$UserId);
        $User = $reqUser->fetch();
        
        return $User;
    }
        
    public function deleteUser($_id, $_pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE id, pseudo, password, mail, role FROM users');
        $User = $req->execute(array($_id, $_pseudo, $_password, $_mail, $_role)); 
    
        return $User;
    }
    
    public function getUser($_id, $_pseudo, $_password, $_mail, $_role)
    {
        $db = $this->dbConnect();
        $User = $db->prepare('SELECT id, pseudo, password, mail, role FROM users WHERE id = ? ORDER BY id DESC');
        $User->execute(array($_id, $_pseudo, $_password, $_mail, $_role));
        
        return $User;
    }
        
    public function getUsers()
    {
        $db = $this->dbConnect();
        
        $Users = $db->prepare('SELECT id, pseudo, password, mail, role FROM users ORDER BY id DESC');
        $Users->execute();        
        
        return $Users;
    }
} 
