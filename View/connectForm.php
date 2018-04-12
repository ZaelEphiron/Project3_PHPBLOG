<?php
/*
Page connectForm.php

Permet de se connecter au site.

Quelques indications : (Utiliser l'outil de recherche et rechercher les mentions données)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
Membre qui essaie de se connecter alors qu'il l'est déjà
Vous êtes bien connecté
Erreur de mot de passe
Erreur de pseudo doublon (normalement impossible)
Pseudo inconnu
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

/*****Entête et titre de page*****/
    
$titre = 'Connexion';
    
include('../includes/haut.php'); //contient le doctype, et head.
    
/*****Fin ent$ete et titre*****/
?>
        <div id="colonne_gauche">
        <?php
        include('../includes/colg.php');
        ?>
        </div>

        <div id="contenu">
            <div id="map">
                <a href="../indexMembers.php">Accueil</a> => <a href="connexion.php">
                Connexion</a>
            </div>
            
            <h1>Formulaire de connexion</h1>
            <p>Pour vous connecter, indiquez votre pseudo et votre mot de passe.<br/>
            Vous pouvez aussi cocher l'option "Me connecter automatiquement à mon prochain passage." pour laisser une trace sur votre ordinateur pour être connecté automatiquement.<br/>
            Ce système de trace est basé sur les cookies, ce sont des petits fichiers 
            contenant votre numéro d'identification ainsi qu'une version cryptée de votre mot de passe. Ces fichiers ne peuvent en aucun cas endommager votre ordinateur, ni l'affecter d'aucune façons, vous pourrez les supprimer à tout moment dans les options de votre navigateur.</p>
                
        <form name="connexion" id="connexion" method="post" action="connexion.php">
            <fieldset><legend>Connexion</legend>
                <label for="pseudo" class="float">Pseudo :</label><input type="text" name ="pseudo" id="pseudo" value="<?php
    if(isset($_SESSION['connexion_pseudo'])) echo $_SESSION['connexion_pseudo']; ?>"/><br/>
                <input type="hidden" name="validate" id="validate" value="ok"/>
                <input type="checkbox" name="cookie" id="cookie"/> <label for="cookie">Me connecter automatiquement à mon prochain passage.</label><br/>
                <div class="center"><input type="submit" value="Connexion"/></div>
            </fieldset>
        </form>    
}
            
<h1>Options</h1>
<p><a href="inscription.php">Je ne suis pas inscrit !</a><br/>
        </div>
                    
<?php
    include('../includes/bas.php');
    mysql_close();
?>