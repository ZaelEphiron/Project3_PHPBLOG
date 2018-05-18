<?php

namespace BlogPHP\Controller;

// Chargement des classes
use BlogPHP\Model\PostsManager;
use BlogPHP\Model\CommentsManager;
use BlogPHP\Model\UsersManager;

class Backend {
    
    public function newPost()
    {
        require('view/backend/addPostView.php');
    }
    
    public function addPost($title, $content)
    {
        $PostsManager = new PostsManager();
    
        $Post = $PostsManager->addPost($title, $content);
    
        if($Post == false)
        {
            throw new \Exception('Impossible d\'ajouter le billet !');
        }
        else {
            header('Location: index.php?action=listPosts');
            exit();
        }
    }

    public function getPost($id) 
    {
        $PostsManager = new PostsManager();
    
        $Post = $PostsManager->getPost($id);
        
        require('view/backend/editPostView.php');
    }

    public function editPost($id, $title, $content)
    {
        $PostsManager = new PostsManager();
    
        $Post = $PostsManager->editPost($id, $title, $content);
        
        if($Post == false)
        {
            throw new \Exception('Impossible d\'ajouter le billet !');
        }
    
        else{
            header('Location: index.php?action=listPosts');
            exit();
        }
    }

    public function confirmDeletePost($id)
    {
        require('view/backend/confirmDeletePostView.php');
    }
    
    public function deletePost($id)
    {
        $PostsManager = new PostsManager();
    
        $Post = $PostsManager->deletePost($id);
        
        if($Post == false)
        {
            throw new \Exception('Impossible de supprimer le billet !');
        }
        else{
            header('Location: index.php?action=listPosts');
            exit();
            }
    }
    
    public function removeReport($commentID)
    {
        $CommentsManager = new CommentsManager();
        
        $affectedComment = $CommentsManager->removeReport($commentID);

        header('Location: index.php?action=listPosts');
    }
    
    public function confirmDeleteComment($commentID)
    {
        require('view/backend/confirmDeleteCommentView.php');
    }
    
    public function deleteComment($commentID)
    {
        $CommentsManager = new CommentsManager();
    
        $affectedComment = $CommentsManager->deleteComment($commentID);
        
        if($affectedComment == false)
        {
            throw new \Exception('Impossible de supprimer le commentaire !');
        }
        else{
            header('Location: index.php?action=listPosts');
            exit();
            }
    }
    
    public function dashboard()
    {
        
        $PostsManager = new PostsManager();
        $Posts = $PostsManager->getPosts();
        
        $CommentsManager = new CommentsManager();
        $Comments = $CommentsManager->getComments();
        
        $UsersManager = new UsersManager();
        $Users = $UsersManager->getUsers();
        
        require("View/backend/adminDashboardView.php");
    }
}
