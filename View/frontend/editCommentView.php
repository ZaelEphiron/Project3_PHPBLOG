<?php ob_start(); ?>
<p><a href="index.php?action=listPosts">Accueil</a></p>

<head>
    <h1>Formulaire de modification de commentaire :</h1>
</head>

<body>
    <form action="index.php?action=editComment&amp;id=<?= $commentID ?>" method="post">
        <div>
            <label for="comment">Commentaire :</label><br />  
            <textarea id="comment" name="comment" value="" /><?= $comment['comment'] ?></textarea>
            <br />
        </div>
        <div>
            <input type="submit" value ="Modifier" />
        </div>
    </form>
</body>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
