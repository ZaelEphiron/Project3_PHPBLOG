<?php ob_start(); ?>
<?php $title = "Tableau de bord admin"; ?>

<header class="major">
    <h2>Tableau de bord d'administration du blog</h2>
</header>

<div class="news">
    <h4>Gestion des billets :</h4>
        
    <a href="index.php?action=newPost">Ajouter un billet</a> 
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nom de la page</th>
                    <th>Contenu</th>
                    <th>Date de publication</th>
                    <th>Lien vers les commentaires</th>
                    <th>Options d'administration</th>
                </tr>
            </thead>
            <tbody>
        <?php
        while ($data = $posts->fetch())
        {
        ?>
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
                        <td>
                            <a href="index.php?action=getPost&amp;id=<?= $data['id'] ?>">Modifier le billet.</a>
                            <a href="index.php?action=confirmDeletePost&amp;id=<?= $data['id'] ?>">Supprimer le billet.</a>
                        </td>
                    </tr>
                
        <?php
        }
        $posts->closeCursor();
        ?>
            </tbody>
        </table>
    </div>
</div>
    
<div class="news">
    <h4>Gestion des commentaires :</h4>
<?php
    while($comment = $comments->fetch())
    {
?>
        <h1>
            <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> <br />
            <?= nl2br(htmlspecialchars($comment['comment'])) ?></h1>
        <?php
        if($comment['report'] != 0){
        ?>
        <em><?= nl2br(htmlspecialchars($comment['report'])) ?></em>
        <a href="index.php?action=removeReport&amp;id=<?= $comment['id']?>">Retirer le signalement</a>
        <?php
        }
        ?>
    <?php
    }
    ?>
</div>
    
<div class="news">
    <h4>Gestion des utilisateurs :</h4>
        <?php
        while($user = $users->fetch())
        {
        ?>
        <h1>
            <?= htmlspecialchars($user['pseudo']); ?> 
            <?= htmlspecialchars($user['mail']); ?>
            <a href="index.php?action=deleteUser&amp;id=<?= $user['id']?>">Supprimer l'utilisateur</a>
        <h1>
        <?php
        }
        ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("view/template.php"); ?>
        