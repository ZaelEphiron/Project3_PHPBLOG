<?php ob_start(); ?>
<?php $title ='Mon blog'; ?>

<head>
    <a href="listPostsView.php">Accueil</a>
    <h1>Bienvenue sur le blog de Jean Forteroche !</h1>

</head>

<body>
    <h2>Description de l'artiste :</h2>
    <a href="index.php?action=sessionAdminView">Se connecter</a>
    <p>Bonjour et bienvenue sur mon blog !
 
        Je suis un artiste écrivain et ceci sera le blog où je posterai, en avant première, les pages de mon nouveau roman en cours de rédaction. Je posterai donc régulièrement les pages, au fûr et à mesure de leur création, les unes-après les autres et comptent sur vous pour commenter ses pages dans le but de recueillir vos idées et ainsi d'améliorer le contenu de ce roman qui s'intitulera : "Billet simple pour l'Alaska".
 
        Je vous souhaite à tous une bonne lecture !</p>

    <h2>Derniers billets du blog :</h2>
<?php
while ($data = $posts->fetch())
{
?>
<div class="news">
    <h3>
        <?= htmlspecialchars($data['title']) ?>
        <em>le <?= $data['creation_date_fr'] ?></em>
        <a href="editPostView.php">Modifier le billet.</a>
        <a href="deletePostView.php">Supprimer le billet.</a>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($data['content'])) ?>
        <br />
        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
    </p>
</div>
<?php
}
$posts->closeCursor();
?>
    
<a href="addPostView.php">Ajouter un billet</a> 
</body>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
