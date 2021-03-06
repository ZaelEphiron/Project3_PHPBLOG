<?php ob_start(); ?>
<?php $title ='Mon blog'; ?>

<header class="major">
    <h3>Billet simple pour l'Alaska :</h3>
</header>

<div class="news">
    <?php
    while ($data = $posts->fetch())
    {
    ?>
        <h4>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h4>
        <p><?= nl2br($data['content']) ?></br>
        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Voir plus ></a></em></p>
<?php
}
$posts->closeCursor();
?>                                         

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
