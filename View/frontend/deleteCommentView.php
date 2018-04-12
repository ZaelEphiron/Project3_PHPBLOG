<?php ob_start(); ?>
<?php $title = htmlspecialchars($post['title']); ?>

<head>
    <h1>Formulaire de suppression de commentaire :</h1>
</head>

<body>
    <h2>Êtes-vous sûr de vouloir supprimer ce commentaire ?</h2>
    <form action ="index.php?action=deleteComment" method="post">
        <div>
            <input type="checkbox" name="yes" id="yes" /> <label for="frites">Oui</label><br />
        </div>
        <div>
            <input type="checkbox" name="no" id="no" /> <label for="no">Non</label><br />
        </div>
        <div>
            <input type="submit" value ="Confirmer" />
        </div>
    </form>    
</body>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>