<?php

namespace BlogPHP\Controller;

// Chargement des classes
use BlogPHP\Model\PostsManager;
use BlogPHP\Model\CommentsManager;
use BlogPHP\Model\UsersManager;
use BlogPHP\Controller\Controller;

class Backend extends Controller {
    
    public function newPost()
    {
        require('view/backend/addPostView.php');
    }
    
    public function addPost($title, $content)
    {
        $error = [];
        
        $trimmedTitle = trim($title);
        
        $trimmedContent = trim($content);
        
        if (strlen($trimmedTitle) < 3){
            $error[] = "Titre trop court !";
        }
        if (strlen($trimmedContent) < 3){
            $error[] = "Contenu trop court !";
        }
        if (strlen($trimmedTitle) > 255){
            $error[] = "Titre trop long !";
        }
        if (strlen($trimmedContent) > 500){
            $error[] = "Contenu trop long !";
        }
        if (count($error) != 0){
            
            $_SESSION['error'] = $error; 
                
            return $this->response->redirect('newPost');
        }
        
        $postsManager = new PostsManager();
        $post = $postsManager->addPost($title, $content);
        
        if($post == false)
        {
            throw new \Exception('Impossible d\'ajouter le billet !');
        }
        else {
            return $this->response->redirect('listPosts');
        }
    }

    public function getPost($id) 
    {
        $postsManager = new PostsManager();
    
        $post = $postsManager->getPost($id);
        
        require('view/backend/editPostView.php');
    }

    public function editPost($id, $title, $content)
    {   
        $error = [];
        
        $trimmedTitle = trim($title);
        
        $trimmedContent = trim($content);
        
        if (strlen($trimmedTitle) < 3){
            $error[] = "Titre trop court !";
        }
        if (strlen($trimmedContent) < 3){
            $error[] = "Contenu trop court !";
        }
        
        if (strlen($trimmedTitle) > 255){
            $error[] = "Titre trop long !";
        }
        if (strlen($trimmedContent) > 500){
            $error[] = "Contenu trop long !";
        }
        
        if (count($error) != 0){
            
            $_SESSION['error'] = $error;
            
             return $this->response->redirect('getPost');
        }
        
        $postsManager = new PostsManager();
    
        $post = $postsManager->editPost($id, $title, $content);
        
        if($post == false)
        {
            throw new \Exception('Impossible d\'ajouter le billet !');
        }
    
        else{
             return $this->response->redirect('listPosts');
        }
    }

    public function confirmDeletePost()
    {
        require('view/backend/confirmDeletePostView.php');
    }
    
    public function deletePost($id)
    {
        $postsManager = new PostsManager();
    
        $post = $postsManager->deletePost($id);
        
        if($post == false)
        {
            throw new \Exception('Impossible de supprimer le billet !');
        }
        else{
             return $this->response->redirect('listPosts');
            }
    }
    
    public function removeReport($commentID)
    {
        $commentsManager = new CommentsManager();
        
        $affectedComment = $commentsManager->removeReport($commentID);

         return $this->response->redirect('listPosts');
    }
    
    public function confirmDeleteComment()
    {
        require('view/backend/confirmDeleteCommentView.php');
    }
    
    public function deleteComment($commentID)
    {
        $commentsManager = new CommentsManager();
    
        $affectedComment = $commentsManager->deleteComment($commentID);
        
        if($affectedComment == false)
        {
            throw new \Exception('Impossible de supprimer le commentaire !');
        }
        else{
             return $this->response->redirect('listPosts');
            }
    }
    
    public function dashboard()
    {
        
        $postsManager = new PostsManager();
        $posts = $postsManager->getPosts();
        
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->getComments();
        
        $usersManager = new UsersManager();
        $users = $usersManager->getUsers();
        
        require("View/backend/adminDashboardView.php");
    }
}
