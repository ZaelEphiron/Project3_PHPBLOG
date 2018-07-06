<?php ob_start(); ?>
<?php $title = "Modifier un commentaire"; ?>

<header class="major">
    <h1>Formulaire de modification de commentaire :</h1>
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

    <form action="index.php?action=editComment&amp;id=<?= $commentId ?>" method="post">
        <div>
            <label for="comment">Commentaire :</label><br />  
            <textarea id="comment" name="comment" value="" /><?= $comment['comment'] ?></textarea>
            <br />
        </div>
        <div>
            <input type="submit" value ="Modifier" />
        </div>
    </form>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
