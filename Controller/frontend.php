<?php

namespace BlogPHP\Controller;

// Chargement des classes
use BlogPHP\Model\PostsManager;
use BlogPHP\Model\CommentsManager;
use BlogPHP\Model\UsersManager;
use BlogPHP\Controller\Controller;

class Frontend extends Controller {
    
    public function listPosts()
    {
        $postsManager = new PostsManager();
        $posts = $postsManager->getPosts();
        require('view/frontend/listPostsView.php');
    }

    public function post()
    {
        $postsManager = new PostsManager();
        $commentsManager = new CommentsManager();

        $post = $postsManager->getPost($_GET['id']);
        $comments = $commentsManager->getComments($_GET['id']);
        
        require('view/frontend/postView.php');
    }

    public function addComment($postId, $author, $comment)
    {   
        $error = [];
        
        $trimmedAuthor = trim($author);
        
        $trimmedComment = trim($comment);
        
        if (strlen($trimmedAuthor) < 3){
            $error[] = "Nom de l'auteur trop court !";
        }
        if (strlen($trimmedComment) < 3){
            $error[] = "Commentaire trop court !";
        }
        
        if (strlen($trimmedAuthor) > 255){
            $error[] = "Nom de l'auteur trop long !";
        }
        if (strlen($trimmedComment) > 500){
            $error[] = "Commentaire trop long !";
        }
        
        if (count($error) != 0){
            
            $_SESSION['error'] = $error;
            
            return $this->response->redirect('post&id='.$postId);
        }
        
        $commentsManager = new CommentsManager();
    
        $comment = $commentsManager->addComment($postId, $author, $comment);
    
        if($comment == false){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            
            return $this->response->redirect('post&id='.$postId);
        }
    }

    public function getComment($commentId)
    {
        $commentsManager = new CommentsManager();
    
        $comment = $commentsManager->getComment($_GET['id']);
    
        require('view/frontend/editCommentView.php');
    }

    public function editComment($commentId, $comment)
    {   
        $error = [];
        
        $trimmedComment = trim($comment);
        
        if (strlen($trimmedComment) < 3){
            $error[] = "Commentaire trop court !";
        }
        if (strlen($trimmedComment) > 500){
            $error[] = "Commentaire trop long !";
        }
        
        if (count($error) != 0){
            
            $_SESSION['error'] = $error;
            
            return $this->response->redirect("getComment&id='.$commentId'");
        }
        
        $commentsManager = new CommentsManager();

        $affectedComment = $commentsManager->editComment($commentId, $comment);
    
        $comment = $commentsManager->getComment($commentId);
        $postId = $comment['post_id'];
    
        if($affectedComment == false){
            throw new Exception('Erreur lors de la modification !');
        }
        else {
             return $this->response->redirect('listPosts');
        }
    }

    public function reportComment($commentId)
    {
        $commentsManager = new CommentsManager();
        
        $affectedComment = $commentsManager->reportComment($commentId);

         return $this->response->redirect('listPosts');
    }
    
    public function error404()
    {
        require('view/frontend/errorView.php');
    }
}
