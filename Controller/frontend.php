<?php

namespace BlogPHP\Controller;

// Chargement des classes
use BlogPHP\Model\PostsManager;
use BlogPHP\Model\CommentsManager;
use BlogPHP\Model\UsersManager;

class Frontend {

    public function listPosts()
    {
        $PostsManager = new PostsManager();
        $Posts = $PostsManager->getPosts();
        require('view/frontend/listPostsView.php');
    }

    public function post()
    {
        $PostsManager = new PostsManager();
        $CommentsManager = new CommentsManager();

        $Post = $PostsManager->getPost($_GET['id']);
        $Comments = $CommentsManager->getComments($_GET['id']);
        
        require('view/frontend/postView.php');
    }

    public function addComment($postID, $author, $Comment)
    {   
        $CommentsManager = new CommentsManager();
    
        $Comment = $CommentsManager->addComment($postID, $author, $Comment);
    
        if($Comment == false){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postID);
        }
    }

    public function getComment($commentID)
    {
        $CommentsManager = new CommentsManager();
    
        $Comment = $CommentsManager->getComment($_GET['id']);
    
        require('view/frontend/editCommentView.php');
    }

    public function editComment($commentID, $Comment)
    {   
        $CommentsManager = new CommentsManager();
    
        $affectedComment = $CommentsManager->editComment($commentID, $Comment);
    
        $Comment = $CommentsManager->getComment($commentID);
        $postID = $Comment['post_id'];
    
        if($affectedComment == false){
            throw new Exception('Erreur lors de la modification !');
        }
        else {
            header('Location: index.php?action=listPosts');
            exit();
        }
    }

    public function reportComment($commentID)
    {
        $CommentsManager = new CommentsManager();
        
        $affectedComment = $CommentsManager->reportComment($commentID);

        header('Location: index.php?action=listPosts');
    }
}