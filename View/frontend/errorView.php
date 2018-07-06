<?php
require('controler/frontend.php');

try {
    // ...
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}

echo 'Erreur 404 : Cette page n\'existe pas';
