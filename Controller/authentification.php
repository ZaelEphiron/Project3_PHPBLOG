<?php 

require_once('Model/postsManager.php');
require_once('Model/commentsManager.php');
require_once('Model/usersManager.php');

// Chargement des classes
use \Blogphp\Model\PostsManager;
use \Blogphp\Model\CommentsManager;
use \Blogphp\Model\UsersManager;

class Authentification {
    
    public function verifId()
    {
        $userManager = new userManager();
    
        if(isset ($_POST['pseudo']))
        {
        
        $user = $userManager->verifId($_POST['pseudo']);
    
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
        $userManager = new userManager();
    
        $user = $userManager->addUser($id, $pseudo, password_hash($password, PASSWORD_BCRYPT), $mail, $role);
    
        if($user == false){
            throw new Exception('L\'inscription n\'a pas pu aboutir !');
        }
        else {
            header('Location: index.php');
        }
    }
        
    public function deleteUser($id, $pseudo, $password, $mail, $role)
    {
        $userManager = new userManager();
    
        $affectedUser = $userManager->deleteUser($id, $pseudo, $password, $mail, $role);
    
        //require('view/frontend/deleteCommentView.php');
    }
    
    public function getUser($_id, $pseudo, $_password, $_mail, $_role)
    {
        $userManager = new userManager();
    
        $user = $userManager->getUser($_GET['id']);
    
        //require('view/frontend/updateCommentView.php');
    }
        
    public function getUsers($_id, $pseudo, $_password, $_mail, $_role)
    {
        $userManager = new userManager();
        $users = $userManager->getUsers();
        
        //require('view/frontend/listPostsView.php');  
    }
    
    private function encrypt($pure_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }
    
    private function decrypt($encrypted_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }
}

/*    
    
    

$messageAChiffrer = "Coucou je suis Guillaume";
$cleSecrete = "MaCleEstIncassable";


// On chiffre le message
$messageChiffre = encrypt($messageAChiffrer, $cleSecrete);

// Pour le lire
$messageDechiffrer = decrypt($messageChiffre, $cleSecrete);
?>

*/