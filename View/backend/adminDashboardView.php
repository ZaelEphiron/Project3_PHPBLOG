<?php ob_start(); ?>
<?php $title = "Tableau de bord admin"; ?>

<head>
    <h1>Tableau de bord d'administration du blog :</h1>
</head>

<body>
<?php
while ($data = $Posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
    
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
        </p>
    <?php
}
$Posts->closeCursor();
?>
    </div>
    <div class="news">
        <?php
        while($Comment = $Comments->fetch())
        {
        ?>
        <h3>
            <strong><?= htmlspecialchars($Comment['author']) ?></strong> le <?= $Comment['comment_date_fr'] ?>
        </p>
        <h3><?= nl2br(htmlspecialchars($Comment['comment'])) ?></h3>
        <?php
        if($Comment['report'] != 0){
        ?>
        <em><?= nl2br(htmlspecialchars($Comment['report'])) ?></em>
        <a href="index.php?action=removeReport&amp;id=<?= $Comment['id']?>">Retirer le signalement</a>
        <?php
        }
        ?>
        <?php
        }
        ?>
    </div>
    <div class="news">
        <?php
        while($User = $Users->fetch())
        {
        ?>
        <h3>
            <?= htmlspecialchars($User['pseudo']); ?> 
            <?= htmlspecialchars($User['mail']); ?>
            <a href="index.php?action=deleteUser&amp;id=<?= $User['id']?>">Supprimer l'utilisateur</a>
        <h3>
        <?php
        }
        ?>
    </div>
</body>

<?php $content = ob_get_clean(); ?>

<?php require("view/template.php"); ?>