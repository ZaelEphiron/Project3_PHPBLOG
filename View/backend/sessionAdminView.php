<?php ob_start(); ?>
<?php $title = "Login"; ?>

<head>
    <h1>Zone d'authentification :</h1>
    <p>
        Cette page est réservé à l'admin, Mr Forteroche.
        Si vous êtes Monsieur Forteroche alors vous pouvez vous identifiez afin de bénéficier des droits d'administrateurs sur le blog.
        Sinon, passez votre chemin !
    </p>
</head>

<body>
    <h2>Veuillez saisir votre mot de passe d'authentification :</h2>
    <form action ="index.php?action=sessionAdmin" method="post">
        <div>
            <label for="password">Mot de passe :</label><br />
            <input type="text" id="password" name="password" value="" />
            <br />
        </div>
        <div>
            <input type="submit" value ="Confirmer" />
        </div>
    </form>    
</body>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>