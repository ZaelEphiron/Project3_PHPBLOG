<?php ob_start(); ?>
<?php $title = "Erreur 404"; ?>
<?php
require('controler/frontend.php');

/*
try {
    // ...
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
*/

echo 'Erreur 404 : Cette page n\'existe pas';
?>

<li><a href="index.php?action=listPosts">Accueil</a></li>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>