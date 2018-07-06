<?php ob_start(); ?>
<?php $title ='Mon blog'; ?>

<header class="major">
<h3>Formulaire d'inscription</h3>
</header>
    <form method="post" action="index.php?action=addUser">
        <div class="row uniform">
            <div class="6u 12u(xsmall)">
				    <input type="text" name="pseudo" id="pseudo" value="" placeholder="pseudo" />
            </div>
        </div>
            <div class="row uniform">
                <div class="6u 12u(xsmall)">
				    <input type="password" name="password" id="password" value="" placeholder="password" />
                </div>
            <div class="6u 12u(xsmall)">
				<input type="email" name="mail" id="mail" value="" placeholder="mail" />
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
<?php require('view/template.php'); ?>
