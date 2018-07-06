<?php ob_start(); ?>
<?php $title = "Login"; ?>

<header class="major">
    <h3>Zone d'authentification :</h3>
</header>

    <h2>Veuillez saisir votre mot de passe d'authentification :</h2>
    <form action ="index.php?action=checkLog" method="post">
        <div>
            <label for="pseudo">Pseudo :</label><br />
            <input type="text" id="pseudo" name="pseudo" value="" /><br />
            <label for="password">Mot de passe :</label><br />
            <input type="password" id="password" name="password" value="" />
            <br />
        </div>
        <div>
            <br />
            <input type="submit" value ="Confirmer" />
        </div>
    </form>    

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>