<?php ob_start(); ?>
<?php $title = "Modifier un billet"; ?>

<header class="major">
    <h1>Formulaire d'édition de billet :</h1>
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

    <form action="index.php?action=editPost&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="title">Titre :</label><br />
            <input type="text" id="titre" name="title" value="<?= $post['title']?>" /></input>
        </div>
        <div>
            <label for="content">Contenu :</label><br />  
            <textarea class="tinymce" id="content" name="content" value="" /><?= $post['content'] ?>   </textarea>
            <br />
        </div>
        <div>
            <input type="submit" value ="Modifier" />
        </div>
    </form>

<script src="Public/assets/js/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '.tinymce'
  });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>