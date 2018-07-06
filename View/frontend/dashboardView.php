<?php ob_start(); ?>
<?php $title = "Tableau de bord"; ?>

<header class="major">
    <h1>Tableau de bord :</h1>
</header>
    
     <form method="post" action="#">
        <h2>Modifier le pseudo :</h2>
         <div class="row uniform">
            <div class="6u 12u(xsmall)">
				    <input type="text" name="pseudo" id="pseudo" value="<?= $user['pseudo'] ?>" placeholder="pseudo" />
            </div>
        </div>
        <h2>Modifier le mot de passe :</h2>
        <div class="row uniform">
                <div class="6u 12u(xsmall)">
				    <input type="text" name="password" id="password" value="<?= $user['password'] ?>" placeholder="password" />
                </div>
        </div>
        <h2>Modifier l'adresse mail</h2>
         <div class="row uniform">
            <div class="6u 12u(xsmall)">
				<input type="email" name="email" id="email" value="<?= $user['email'] ?>" placeholder="Email" />
            </div>
        </div>
        <div class="row uniform">
            <div class="12u">
				<ul class="actions">
				    <li><input type="submit" value="Envoyer le formulaire" /></li>
				</ul>
            </div>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require("view/template.php"); ?>