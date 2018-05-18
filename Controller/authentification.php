<?php 

namespace BlogPHP\Controller;

// Chargement des classes
use BlogPHP\Model\PostsManager;
use BlogPHP\Model\CommentsManager;
use BlogPHP\Model\UsersManager;

class Authentification {
    
    public function verifId()
    {
        $UsersManager = new UsersManager();
    
        if(isset ($_POST['pseudo']))
        {
        
        $user = $UsersManager->verifId($_POST['pseudo']);
    
        if($user->getPassword() != password_hash($_POST['password'], PASSWORD_BCRYPT)){
            throw new Exception('Les identifiants ne correspondent pas');
        }
        else {
            header('Location: index.php');
        }
    }
}
    
    public function addUser($id, $pseudo, $password, $mail, $role)
    {
        $UsersManager = new UsersManager();
    
        $user = $UsersManager->addUser($id, $pseudo, password_hash($password, PASSWORD_BCRYPT), $mail, $role);
    
        if($user == false){
            throw new Exception('L\'inscription n\'a pas pu aboutir !');
        }
        else {
            header('Location: index.php');
        }
    }
        
    public function deleteUser($id, $pseudo, $password, $mail, $role)
    {
        $UsersManager = new UsersManager();
    
        $affectedUser = $UsersManager->deleteUser($id, $pseudo, $password, $mail, $role);
    
        //require('view/frontend/deleteCommentView.php');
    }
    
    public function getUser($_id, $pseudo, $_password, $_mail, $_role)
    {
        $UsersManager = new UsersManager();
    
        $user = $UsersManager->getUser($_GET['id']);
    
        //require('view/frontend/updateCommentView.php');
    }
        
    public function getUsers($_id, $pseudo, $_password, $_mail, $_role)
    {
        $UsersManager = new UsersManager();
        $users = $UsersManager->getUsers();
        
        //require('view/frontend/listPostsView.php');  
    }
    
    public function login()
    {
        require("View/backend/sessionAdminView.php");
    }
    
}
