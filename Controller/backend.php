<?php

namespace BlogPHP\Controller;

require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');

// Chargement des classes
use \Blogphp\Model\PostsManager;
use \Blogphp\Model\CommentsManager;

class Backend {

    public function addPost($postId, $title, $content)
    {
        $postManager = new postManager();
    
        $post = $postManager->addPost($postId, $title, $content);

        require('view/frontend/addPostView.php');
    
        if($post == false)
        {
            throw new Exception('Impossible d\'ajouter le billet !');
        }
        else {
            header('Location: index.php?action=addPost');
            exit();
        }
    }

    public function getPost($postId) 
    {
        $postManager = new postManager();
    
        $post = $postManager->getPost($postId);
    }

    public function editPost($postId, $title, $content)
    {
        $postManager = new postManager();
    
        $post = $postManager->editPost($postId, $title, $content);
    
        require('view/frontend/editPostView.php');
    
        if($post == false)
        {
            throw new Exception('Impossible d\'ajouter le billet !');
        }
    
        else{
            header('Location: index.php?action=editPost');
            exit();
        }
    }

    public function deletePost($postId, $title, $content)
    {
        $postManager = new postManager();
    
        $post = $postManager->deletePost($postId, $title, $content);
    
        require('view/frontend/deletePostView.php');
    }
    
    public function sessionAdmin()
    {
        
    }
}
