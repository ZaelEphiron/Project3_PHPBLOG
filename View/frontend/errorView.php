<?php ob_start(); ?>
<?php $title = "Erreur 404"; ?>

<header class="major">
    <h1>Erreur 404 : la page demandée n'existe pas</h1>
</header>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>