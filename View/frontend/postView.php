<?php ob_start(); ?>
<?php $title = htmlspecialchars($post['title']); ?>

<header class="major">
    <h3>Lecture du billet</h3>
</header>

<div class="news">
    <h1>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h1>
            
    <p>
        <?= nl2br($post['content']) ?>
    </p>
</div>

<h4>Liste des commentaires associés :</h4>

<?php include('View/frontend/addCommentView.php'); ?>

<?php
while($comment = $comments->fetch())
{
?>

    <p>
        <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?>
        <a href="index.php?action=getComment&amp;id=<?= $comment['id'] ?>"> (modifier)</a>
    <?php   if (array_key_exists('role', $_SESSION)){
                            if ($_SESSION['role'] === 'admin'){
                        ?>
        <a href="index.php?action=confirmDeleteComment&amp;id=<?= $comment['id'] ?>"> (supprimer)</a>
    <?php
                            }
            }
    ?>
        <a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>"> (signaler)
        </a>
    </p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
?>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
