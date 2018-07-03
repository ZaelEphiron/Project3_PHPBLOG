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
    
    public function addUser($pseudo, $password, $mail)
    {
        $UsersManager = new UsersManager();
    
        $User = $UsersManager->addUser($pseudo, password_hash($password, PASSWORD_BCRYPT), $mail);
        
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
    
        $UsersManager->deleteUser($id, $pseudo, $password, $mail, $role);
    }
    
    /*
    public function getUser()
    {
        $UsersManager = new UsersManager();
    
        $User = $UsersManager->getUser($_GET['id']);
    }
        
    public function getUsers()
    {
        $UsersManager = new UsersManager();
        
        $Users = $UsersManager->getUsers();
    }
    */
    
    public function inscription()
    {
        require("View/frontend/inscriptionView.php");
    }
    
    public function login()
    {
        require("View/frontend/loginView.php");
    }
    
    public function logout()
    {
        session_unset();
        session_destroy();
        
        header('Location: index.php?action=listPosts');
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
