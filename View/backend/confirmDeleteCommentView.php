<?php ob_start(); ?>
<?php $title = "Supprimer un commentaire"; ?>

<header class="major">
    <h1>Formulaire de suppression de commentaire :</h1>
</header>

    <h2>Êtes-vous sûr de vouloir supprimer ce commentaire ?</h2>
    
    <form action ="index.php?action=deleteComment&amp;id=<?= $_GET['id']?>" method="post">
        <div>
            <input type="checkbox" name="yes" id="yes" /> <label for="yes">Oui</label><br />
        </div>
        <div>
            <input type="checkbox" name="no" id="no" /> <label for="no">Non</label><br />
        </div>
        <div>
            <input type="submit" value ="Confirmer" />
        </div>
    </form>    

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
