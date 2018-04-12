<?php

require_once('model/postsManager.php');
require_once('model/commentsManager.php');

// Chargement des classes
use \Blogphp\Model\postsManager;
use \Blogphp\Model\commentsManager;

class Frontend {

    public function listPosts()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require('view/frontend/listPostsView.php');
    }

    public function post()
    {
        $postManager = new postManager();
        $commentManager = new commentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
    
        require('view/frontend/postView.php');
    }

    public function addComment($postID, $author, $comment)
    {
        $commentManager = new commentManager();
    
        $comment = $commentManager->postComment($postID, $author, $comment);
    
        if($comment == false){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postID);
        }
    }

    public function getComment($commentID)
    {
        $commentManager = new commentManager();
    
        $comment = $commentManager->getComment($_GET['id']);
    
        require('view/frontend/updateCommentView.php');
    }

    public function editComment($commentID, $comment)
    {
        $commentManager = new commentManager();
    
        $affectedComment = $commentManager->editComment($commentID, $comment);
    
        $comment = $commentManager->getComment($commentID);
        $postID = $comment['post_id'];
    
        $comment='Test';
    
        if($affectedComment == false){
            throw new Exception('Erreur lors de la modification !');
        }
        else {
            header('Location: index.php?action=listPosts');
            exit();
        }
    }

    public function deleteComment($postId, $commentID, $comment)
    {
        $commentManager = new commentManager();
    
        $affectedComment = $commentManager->deleteComment($id, $content);
    
        require('view/frontend/deleteCommentView.php');
    }

    public function reportComment($id, $postId, $commentID, $comment)
    {
        $commentManager = new commentManager();
        
        $affectedComment = $commentManager->reportComment($id, $postId, $commentID $comment);
            
        require('view/frontend/reportCommentView.php');
    }
}