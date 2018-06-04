<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title ='Mon blog'; ?>

<head>
    <style type="text/css">
        body { padding-top: 70px; }
    </style>  
</head>

<body>
    <!--
    <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Bienvenue sur le blog de Jean Forteroche !</a>
        </div>
            <ul class="nav navbar-nav">
                <li class="active"> <a href="index.php?action=listPosts">Accueil</a> </li>
                <li><a href="index.php?action=login">Se connecter</a></li>
                
                <li><a href="index.php?action=dashboard">Tableau de bord</a></li>
                
            </ul>
        </div>
    </div>
    -->

    <h2>Description de l'artiste :</h2>

    <p>Bonjour et bienvenue sur mon blog !
        <br />
        Je suis un artiste écrivain et ceci sera le blog où je posterai, en avant première, les pages de mon nouveau roman en cours de rédaction. Je posterai donc régulièrement les pages, au fûr et à mesure de leur création, les unes-après les autres et comptent sur vous pour commenter ses pages dans le but de recueillir vos idées et ainsi d'améliorer le contenu de ce roman qui s'intitulera : "Billet simple pour l'Alaska".
        <br />
        Je vous souhaite à tous une bonne lecture !</p>

 <h4>Liste des pages du roman :</h4>
<?php
while ($data = $Posts->fetch())
{
?>
<div class="news">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nom de la page</th>
                    <th>Contenu</th>
                    <th>Date de publication</th>
                    <th>Lien vers les commentaires</th>
                </tr>
            </thead>
            <tbody>
				<tr>
                    <td>
                        <?= htmlspecialchars($data['title']) ?>
                    </td>
                    <td>
                        <?= nl2br(htmlspecialchars($data['content'])) ?>
                    </td>
                    <td>
                        <em>le <?= $data['creation_date_fr'] ?></em>
                    </td>
                    <td>
                        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
                    </td>
                </tr>
        </tbody>
    </div>
</div>
<?php
}
$Posts->closeCursor();
?>    

<?php
/*
    if ($_SESSION['role'] == 'admin' && $_SESSION['pseudo'] == 'Forteroche'){
*/
?>    

<!-- <a href="index.php?action=newPost">Ajouter un billet</a> -->

<?php
// }
?>                                      
</body>

<?php $content = ob_get_clean(); ?>
<?php session_unset(); ?>
<?php session_destroy(); ?>
<?php require('view/template.php'); ?>
