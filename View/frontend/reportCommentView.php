<?php ob_start(); ?>
<p><a href="index.php?action=listPosts">Accueil</a></p>

<head>
    <h1>Formulaire de signalement de commentaire :</h1>
</head>

<body>
    <form action="index.php?action=report&amp;id=<?= $commentID ?>" method="post">
        <div>
            <label for="report">Pourquoi voulez vous signalez ce commentaire ?</label><br />  
            <textarea id="reportReason" name="reportReason" value="" /></textarea>
            <br />
        </div>
        <div>
            <input type="submit" value ="Soumettre" />
        </div>
    </form>
</body>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
