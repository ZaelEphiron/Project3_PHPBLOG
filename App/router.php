<?php
namespace BlogPHP\App;

require('Controller/frontend.php');
require('Controller/backend.php');

class Router
{   
    public function getRoute($url)
    {
        var_dump($url);
        $frontend = new Frontend();
        $backend = new Backend();
        
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'listPosts') {
                $frontend->listPosts();
            }
            elseif ($_GET['action'] == 'post') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend->post();
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }
            elseif ($_GET['action'] == 'addComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }
            elseif ($_GET['action'] == 'getComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) { 
                $frontend->getComment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
            elseif ($_GET['action'] == 'editComment'){
                if (isset($_GET['id']) && $_GET['id'] > 0)
                {
                    if (!empty($_POST['comment'])){
                    $frontend->editComment($_GET['id'], $_POST['comment']);
                    } else{
                        throw new Exception('La modification est un échec !');
                        }
                } else {
                throw new Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
            elseif ($_GET['action'] == 'deleteComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend->deleteComment($_GET['id']);
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
            elseif ($_GET['action'] == 'addPost') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        $backend->addPost($_GET['id'], $_POST['title'], $_POST['content']);
                    } else{
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé !');
                }
            }
        }
        elseif ($_GET['action'] == 'getPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
            $backend->getPost($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé !');
            }
        }
        elseif ($_GET['action'] == 'editPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    $backend->editPost($_GET['id'], $_POST['title'], $_POST['content']);
                } else {
                    throw new Exception('Impossible de modifier le commentaire');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé !');
            }
        }
        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $backend->deletePost($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé !');
            }
        } elseif ($_GET['action'] == 'reportComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) { 
                $frontend->getComment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
        else {
            $frontend->listPosts();
            }
    }
}