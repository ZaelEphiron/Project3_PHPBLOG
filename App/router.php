<?php
namespace BlogPHP\App;

use BlogPHP\Controller\Frontend;
use BlogPHP\Controller\Backend;
use BlogPHP\Controller\Authentification;

class Router
{   
    public function getRoute()
    {
        $frontend = new Frontend();
        $backend = new Backend();
        $authentification = new Authentification();
        
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'listPosts') {
                $frontend->listPosts();
            }
            elseif ($_GET['action'] === 'post') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend->post();
                }
                else {
                    throw new \Exception('Aucun identifiant de billet envoyé');
                }
            }
            elseif ($_GET['action'] === 'addComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else {
                    throw new \Exception('Aucun identifiant de billet envoyé');
                }
            }
            elseif ($_GET['action'] === 'getComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) { 
                $frontend->getComment($_GET['id']);
                }
                else {
                    throw new \Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
            elseif ($_GET['action'] === 'editComment'){
                if (isset($_GET['id']) && $_GET['id'] > 0)
                {
                    if (!empty($_POST['comment'])){
                    $frontend->editComment($_GET['id'], $_POST['comment']);
                    } else{
                        throw new \Exception('La modification est un échec !');
                        }
                } else {
                throw new \Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
             elseif ($_GET['action'] === 'confirmDeleteComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $backend->confirmDeleteComment($_GET['id']);
                    } else {
                    throw new \Exception('Aucun identifiant de billet envoyé !');
                    }
            }
            elseif ($_GET['action'] === 'deleteComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $backend->deleteComment($_GET['id']);
                } else {
                    throw new \Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
            elseif ($_GET['action'] === 'newPost') {
                $backend->newPost();
            }
            elseif ($_GET['action'] === 'addPost') {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        $backend->addPost($_POST['title'], $_POST['content']);
                    } else{
                        throw new \Exception('Tous les champs ne sont pas remplis !');
                    } 
            }
        elseif ($_GET['action'] === 'getPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
            $backend->getPost($_GET['id']);
            } else {
                throw new \Exception('Aucun identifiant de billet envoyé !');
            }
        }
        elseif ($_GET['action'] === 'editPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    $backend->editPost($_GET['id'], $_POST['title'], $_POST['content']);
                } else {
                    throw new \Exception('Impossible de modifier le billet');
                }
            } else {
                throw new \Exception('Aucun identifiant de billet envoyé !');
            }
        }
        elseif ($_GET['action'] === 'confirmDeletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $backend->confirmDeletePost($_GET['id']);
                 } else {
                throw new \Exception('Aucun identifiant de billet envoyé !');
            }
        }
        elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $backend->deletePost($_GET['id']);
            } else {
                throw new \Exception('Aucun identifiant de billet envoyé !');
            }
        } elseif ($_GET['action'] === 'reportComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) { 
                    $frontend->reportComment($_GET['id']);
                }
                else {
                    throw new \Exception('Aucun identifiant de commentaire envoyé !');
                }
            }elseif ($_GET['action'] === 'removeReport'){
                if (isset($_GET['id']) && $_GET['id'] > 0){
                    $backend->removeReport($_GET['id']);
                }
                else {
                    throw new \Exception('Aucun identifiant de commentaire envoyé !');
                }
        }elseif ($_GET['action'] === 'inscription'){
            $authentification->inscription(); 
        }elseif ($_GET['action'] === 'addUser'){
            if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['mail'])){
            $authentification->addUser($_POST['pseudo'], $_POST['password'], $_POST['mail']);
            }else{
                throw new \Exception('Tous les champs ne sont pas remplis correctement !');
            }
        }elseif ($_GET['action'] === 'login'){
            $authentification->login();
        }elseif ($_GET['action'] === 'checkLog'){
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                        $authentification->checkLog($_POST['pseudo'], $_POST['password']);
                    } else{
                        throw new \Exception('Tous les champs ne sont pas remplis !');
                    }   
        }elseif ($_GET['action'] === 'dashboard'){
            $backend->dashboard();
        }elseif ($_GET['action'] === 'logout'){
            $authentification->logout();
        }
        else {
        $frontend->error404();
        }
    }
    }
}
