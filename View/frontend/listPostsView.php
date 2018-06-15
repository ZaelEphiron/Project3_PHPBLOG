<?php ob_start(); ?>
<?php $title ='Mon blog'; ?>

<header class="major">
    <h3>Billet simple pour l'Alaska :</h3>
</header>

<div class="news">
    <?php
    while ($data = $Posts->fetch())
    {
    ?>
        <h4>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h4>
        <p><?= nl2br(htmlspecialchars($data['content'])) ?></p>
        
        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
<?php
}
$Posts->closeCursor();
?>                                         

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
