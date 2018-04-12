<?php ob_start(); ?>
<?php $title = htmlspecialchars($post['title']); ?>

<head>
    <h1>Formulaire d'édition de billet :</h1>
</head>

<body>
    <form action="index.php?action=editPost" method="post">
        <div>
            <label for="title">Titre :</label><br />
            <input type="text" id="titre" name="title" value="" /><?= $post['title']?>  </input>
        </div>
        <div>
            <label for="content">Contenu :</label><br />  
            <textarea id="content" name="content" value="" /><?= $post['content'] ?>   </textarea>
            <br />
        </div>
        <div>
            <input type="submit" value ="Modifier" />
        </div>
    </form>
</body>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>