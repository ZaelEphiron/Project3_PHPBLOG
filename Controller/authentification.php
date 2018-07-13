<?php 

namespace BlogPHP\Controller;

// Chargement des classes
use BlogPHP\Model\PostsManager;
use BlogPHP\Model\CommentsManager;
use BlogPHP\Model\UsersManager;
use BlogPHP\App\Response;

class Authentification {
    
    private $response;
    
    public function __construct()
    {
        $this->response = new Response();
    }
    
    public function verifId()
    {
        $usersManager = new UsersManager();
    
        if(isset($_POST['pseudo']))
        {
        
        $user = $usersManager->verifId($_POST['pseudo']);
    
        if($user->getPassword() != password_hash($_POST['password'], PASSWORD_BCRYPT)){
            throw new \Exception('Les identifiants ne correspondent pas');
        }
        else {
            header('Location: index.php?action=listPosts');
        }
    }
}
    
    public function addUser($pseudo, $password, $mail)
    {
        $usersManager = new UsersManager();
    
        $user = $usersManager->addUser($pseudo, password_hash($password, PASSWORD_BCRYPT), $mail);
        
        if($user == false){
            throw new \Exception('L\'inscription n\'a pas pu aboutir !');
        }
        else {
            header('Location: index.php?action=listPosts');
        }
    }
        
    public function deleteUser($id, $pseudo, $password, $mail, $role)
    {
        $usersManager = new UsersManager();
    
        $usersManager->deleteUser($id, $pseudo, $password, $mail, $role);
    }
    
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
        $usersManager = new UsersManager();
        
        $user = $usersManager->verifId($pseudo);
        
        if($user === false){
            throw new \Exception('Les identifiants sont invalides');
        }else{
            if(password_verify($password, $user['password'])){
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['role'] = $user['role'];
                    if($user['role'] == 'admin'){
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
