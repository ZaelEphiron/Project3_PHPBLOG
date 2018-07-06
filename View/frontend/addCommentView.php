<?php ob_start(); ?>
<?php $title = "Ajouter un commentaire"; ?>

<header class="major">
    <h1>Formulaire d'ajout de commentaire :</h1>
</header>

<?php if (array_key_exists('error', $_SESSION)){
            for ($i=0; $i < count($_SESSION['error']); $i++){
                ?>
                <div class="error"><?= $_SESSION['error'][$i]?></div>
            <?php
            }
        unset($_SESSION['error']);
        } 
?>

    <form action ="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
