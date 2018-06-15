<?php ob_start(); ?>
<?php $title = "Modifier un billet"; ?>

<header class="major">
    <h1>Formulaire d'édition de billet :</h1>
</header>
    

    <form action="index.php?action=editPost&amp;id=<?= $Post['id'] ?>" method="post">
        <div>
            <label for="title">Titre :</label><br />
            <input type="text" id="titre" name="title" value="<?= $Post['title']?>" /></input>
        </div>
        <div>
            <label for="content">Contenu :</label><br />  
            <textarea class="tinymce" id="content" name="content" value="" /><?= $Post['content'] ?>   </textarea>
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