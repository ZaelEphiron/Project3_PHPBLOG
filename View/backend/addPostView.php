<?php ob_start(); ?>
<?php $title = "Nouvel article"; ?>

<header class="major">
    <h1>Formulaire d'ajout de billet :</h1>
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
    <form action ="index.php?action=addPost" method="post">
        <div>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" />
        </div>
        <div>
            <label for="content">Contenu</label><br />
            <textarea class="tinymce" id="content" name="content"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<script src="Public/assets/js/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '.tinymce',
    language: 'fr_FR'
  });
  </script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>