<?php ob_start(); ?>
<?php $title = htmlspecialchars($Post['title']); ?>

<header class="major">
    <h3>Lecture du billet</h3>
</header>

<div class="news">
    <h1>
        <?= htmlspecialchars($Post['title']) ?>
        <em>le <?= $Post['creation_date_fr'] ?></em>
    </h1>
            
    <p>
        <?= nl2br(htmlspecialchars($Post['content'])) ?>
    </p>
</div>

<h4>Liste des commentaires associés :</h4>

<form action ="index.php?action=addComment&amp;id=<?= $Post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur :</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire :</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while($Comment = $Comments->fetch())
{
?>

    <p>
        <strong><?= htmlspecialchars($Comment['author']) ?></strong> le <?= $Comment['comment_date_fr'] ?>
        <a href="index.php?action=getComment&amp;id=<?= $Comment['id'] ?>"> (modifier)</a>
        <a href="index.php?action=confirmDeleteComment&amp;id=<?= $Comment['id'] ?>"> (supprimer)</a>
        <a href="index.php?action=reportComment&amp;id=<?= $Comment['id'] ?>"> (signaler)
        </a>
    </p>
    <p><?= nl2br(htmlspecialchars($Comment['comment'])) ?></p>
<?php
}
?>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
