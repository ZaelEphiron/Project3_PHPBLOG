<?php ob_start(); ?>
<?php $title = "Nouvel article"; ?>

<head>
    <h1>Formulaire d'ajout de billet :</h1>
    <script src="js/tinymce.min.js"></script>
</head>

<body onload="tinymce.init({selector:'textarea'})">
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
</body>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>