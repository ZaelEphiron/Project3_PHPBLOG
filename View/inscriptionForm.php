<?php
/*
Page inscription.php

Permet de s'inscrire.

Quelques indications : (utiliser l'outil de recherche et rechercher les mentions données)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
Aucune information/erreur
--------------------------
*/

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/*****Actualisation de la session...*****/

include('../includes/fonctions.php');
connexionbdd();
actualiser_session();

/*****Fin actualisation de session...*****/

if(isset($_SESSION['membre_id']))
{
    header('Location: '.ROOTPATH.'/index.php');
    exit();
}

/*****Entête et titre de page*****/

$titre = 'Inscription 1/2';

include('../includes/haut.php'); //contient le doctype, et head.

/*****Fin entête et titre*****/

?>

<!--Colonne gauche-->
        <div id="colonne_gauche">
        <?php
        include('../includes/colg.php');
        ?>
        </div>

<!--Contenu-->
        <div id="contenu">
            <div id="map">
                <a href="../index.php">Accueil</a> => <a href="inscription.php">Inscription 1/2</a>
            </div>
            
            <?php
            if($_SESSION['erreurs'] > 0)
            {
            ?>
            <div class="border-red">
            <h1>Note :</h1>
            <p>
            Lors de votre dernière tentative d'inscription, des erreurs sont survenues, en voici la liste :<br/>
            <?php
                echo $_SESSION['nb_erreurs'];
                echo $_SESSION['pseudo_info'];
                echo $_SESSION['mdp_info'];
                echo $_SESSION['mdp_verif_info'];
                echo $_SESSION['mail_info'];
                echo $_SESSION['mail_verif_info'];
                echo $_SESSION['date_naissance_info'];
            ?>
            </p>
            </div>
            <?php
            }
            ?>
            
            <h1>Formulaire d'inscription</h1>
            <p>Bienvenue sur la page d'inscription de mon site !<br/>
                Merci de remplir ces champs pour continuer.</p>
            <form action="trait-inscription.php" method="post" name="Inscription">
                <fieldset><legend>Identifiants</legend>
                <label for="pseudo" class="float">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" size="30" value="<?php if($_SESSION['pseudo_info'] == '') echo htmlspecialchars($_SESSION['form_pseudo'], ENT_QUOTES) ; ?>" /> <em>(compris entre 3 et 32 caractères)</em><br />
                    <label for="mdp" class="float">Mot de passe :</label>
                    <input type="password" name="mdp" id="mdp" size="30" value="<?php if($_SESSION['mdp_info'] == '') echo htmlspecialchars($_SESSION['form_mdp'], ENT_QUOTES) ; ?>" /> <em>(compris entre 4 et 50 caractères)</em><br />
                    <label for="mdp_verif" class="float">Mot de passe (vérification) :</label> <input type="password" name="mdp_verif" id="mdp_verif" size="30" value="<?php if($_SESSION['mdp_verif_info'] =='') echo htmlspecialchars($_SESSION['form_mdp_verif'], ENT_QUOTES) ; ?>" /><br />
                    <label for="mail" class="float">Mail :</label>
                    <input type="text" name="mail_verif" id="mail_verif" size="30" value="<?php if($_SESSION['mail_info'] == '') echo htmlspecialchars($_SESSION['form_mail'], ENT_QUOTES); ?>" /><br />
                    <label for="mail_verif" class="float">Mail (vérification) :</label>
                    <input type="text" name="mail_verif" id="mail_verif" size="30" value="<?php if($_SESSION['mail_verif_info'] == '') echo htmlspecialchars($_SESSION['form_mail_verif'], ENT_QUOTES) ; ?>" /><br/>
                    <label for="date_naissance" class="float">Date de naissance</label>
                    <input type="text" name="date_naissance" id="date_naissance" size="30" value="<?php if($_SESSION['date_naissance_info'] = '') echo htmlspecialchars($_SESSION['form_date_naissance'],ENT_QUOTES); ?>" /> <em>(format JJ/MM/AAAA)</em><br/>
                    </fieldset>
                    <div class="center"><input type="submit" value="Inscription" /></div>
            </form>
        </div>

<!--bas-->
<?php
include('../includes/bas.php');
mysql_close();
?>