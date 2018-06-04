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
        
        $User = $UsersManager->verifId($_POST['pseudo']);
    
        if($User->getPassword() != password_hash($_POST['password'], PASSWORD_BCRYPT)){
            throw new \Exception('Les identifiants ne correspondent pas');
        }
        else {
            header('Location: index.php?action=listPosts');
        }
    }
}
    
    public function addUser($id, $pseudo, $password, $mail, $role)
    {
        $UsersManager = new UsersManager();
    
        $User = $UsersManager->addUser($id, $pseudo, password_hash($password, PASSWORD_BCRYPT), $mail, $role);
    
        if($User == false){
            throw new \Exception('L\'inscription n\'a pas pu aboutir !');
        }
        else {
            header('Location: index.php?action=listPosts');
        }
    }
        
    public function deleteUser($id, $pseudo, $password, $mail, $role)
    {
        $UsersManager = new UsersManager();
    
        $affectedUser = $UsersManager->deleteUser($id, $pseudo, $password, $mail, $role);
    
        //require('view/frontend/deleteCommentView.php');
    }
    
    public function getUser($id, $pseudo, $password, $mail, $role)
    {
        $UsersManager = new UsersManager();
    
        $User = $UsersManager->getUser($_GET['id']);
    
        //require('view/frontend/updateCommentView.php');
    }
        
    public function getUsers($id, $pseudo, $password, $mail, $role)
    {
        $UsersManager = new UsersManager();
        
        $Users = $UsersManager->getUsers();
        
        //require('view/frontend/listPostsView.php');  
    }
    
    public function inscription()
    {
        require("View/frontend/inscriptionView.php");
    }
    
    public function confirmedInscription($id, $pseudo, $password, $email, $role){
        
        $UsersManager = new UsersManager();
        
        $User = $UsersManager->addUser($id, $pseudo, $password, $email, $role);
        
        
    }
    
    public function login()
    {
        
        require("View/frontend/loginView.php");
    }
    
    public function checkLog($pseudo, $password)
    {
        $UsersManager = new UsersManager();
        
        $User = $UsersManager->verifId($pseudo);
        
        if($User === false){
            throw new \Exception('Les identifiants sont invalides');
        }else{
            if(password_verify($password, $User['password'])){
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['role'] = $User['role'];
                    if($User['role'] == 'admin'){
                        header('Location: index.php?action=dashboard');
                    }else{
                    echo 'Connecté';
                    }
            }else{
                echo 'Erreur';
            }
        }    
    }
}
