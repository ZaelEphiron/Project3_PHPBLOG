<?php
/*
Page trait-inscription.php

Permet de valider son inscription.

Quelques indications : (utiliser l'outil de recherche et rechercher les mentions données)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
Déjà inscrit (en cas de bug...)
--------------------------
*/

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/*****Actualisation de la session*****/

include('../includes/fonctions.php');
connexionbdd();
actualiser_session();

/*****Fin actualisation de session...*****/

/*****Entête et titre de page*****/

if($_SESSION['erreurs'] > 0) $titre = 'Erreur : Inscription 2/2';
else $titre = 'Inscription 2/2';

include('../includes/haut.php'); //contient le doctype, et head.

/*****Fin entête et titre*****/
?>

        <div id="colonne_gauche">
        <?php
        include('../includes/colg.php');
        ?>
        </div>

        <div id="contenu">
            <div id="map">
<!-- Absence de lien à Insription 2/2 volontaire -->
                <a href="../index.php">Accueil</a> => Inscription 2/2
        </div>
<?php
if(isset($_SESSION['membre_id']))
{
    header('Location: '.ROOTPATH.'/index.php');
    exit();
}

if($_SESSION['inscrit'] == $_POST['pseudo'] && trim($_POST['inscrit']) != '')
{
    $informations = Array(/*Déjà inscrit (en cas de bug...)*/
                        true,
                        'Vous êtes déjà inscrit',
                        'Vous avez déjà complété une inscription avec le pseudo <span class="pseudo">'.htmlspecialchars($_SESSION['inscrit'], ENT_QUOTES).'</span>.',
                                                ' - <a href="'.ROOTPATH.'/index.php">Retourner à l\'index</a>',
                                                ROOTPATH.'/membres/connexion.php',
                                                5
                                                );
    require_once('../information.php');
    exit();
}

/*****Vérification du champ de formulaire*****/

$_SESSION['erreurs'] = 0;

//Pseudo
if(isset($_POST['pseudo']))
{
    $pseudo = trim($_POST['pseudo']);
    $pseudo_result = checkpseudo($pseudo);
    if($pseudo_result == 'tooshort')
    {
        $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo'.htmlspecialchars($pseudo, ENT_QUOTES).' est trop court, vous devez en choisir un plus long (minimum 3 caractères).</span><br/>';
        $_SESSION['form_pseudo'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($pseudo_result == 'toolong')
    {
        $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo'.htmlspecialchars($pseudo, ENT_QUOTES).' est trop long, vous devez en choisr un plus court (maximum 32 caractères).</span><br/>';
        $_SESSION['form_pseudo'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($pseudo_result == 'exists')
    {
        $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo'.htmlspecialchars($pseudo, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
        $_SESSION['form_pseudo'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($pseudo_result == 'ok')
    {
        $_SESSION['pseudo_info'] = '';
        $_SESSION['form_pseudo'] = $pseudo;
    }
    
    else if($pseudo_result == 'empty')
    {
        $_SESSION['pseudo_info'] = '<span class="erreur">Vous n\'avez pas entré de pseudo.</span><br/>';
        $_SESSION['form_pseudo'] = '';
        $_SESSION['erreurs']++;
    }
}

else
{
    header('Location: ../index.php');
    exit();
}

//Mot de passe
if(isset($_POST['mdp']))
{
    $mdp = trim($_POST['mdp']);
    $mdp_result = checkmdp($mdp, '');
    if($mdp_result == 'tooshort')
    {
        $_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entré est trop court, changez-en pour un plus long (minimum 4 caractères).</span><br/>';
        $_SESSION['form_mdp'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($mdp_result == 'toolong')
    {
        $_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entré est trop long, changez-en pour un plus court. (maximum 50 caractères)</span><br/>';
        $_SESSION['form_mdp'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($mdp_result == 'nofigure')
    {
        $_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins un chiffre.</span><br/>';
        $_SESSION['form_mdp'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($mdp_result == 'noupcap')
    {
        $_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins une majuscule.</span><br/>';
        $_SESSION['form_mdp'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($mdp_result == 'ok')
    {
        $_SESSION['mdp_info'] = '';
        $_SESSION['form_mdp'] = $mdp;
    }
    
    else if($mdp_result == 'empty')
    {
        $_SESSION['mdp_info'] = '<span class="erreur">Vous n\'avez pas entré de mot de passe.</span><br/>';
        $_SESSION['form_mdp'] = '';
        $_SESSION['erreurs']++;
        
    }
}

else
{
    header('Location: ../index.php');
    exit();
}

//Mot de passe suite
if(isset($_POST['mdp_verif']))
{
    $mdp_verif = trim($_POST['mdp_verif'];
    $mdp_verif_result = checkmdpS($mdp_verif, $mdp);
    if($mdp_verif_result == 'different')
    {
        $_SESSION['mdp_verif_info'] = '<span class="erreur">Le mot de passe de vérification diffère du mot de passe.</span><br/>';
        $_SESSION['form_mdp_verf'] = '':
        $_SESSION['erreurs']++;
        if(isset($_SESSION['form_mdp'])) unset($_SESSION['form_mdp']);
    }
    
    else
    {
        if($mdp_verif_result == "ok")
        {
            $_SESSION['form_mdp_verif'] = $mdp_verif;
            $_SESSION['mdp_verif_info'] = '';
        }
        
        else
        {
            $_SESSION['mdp_verif_info'] = str_replace('passe', 'passe de vérification', $_SESSION['mdp_info']);
            $_SESSION['form_mdp_verif'] = '';
            $_SESSION['erreurs']++;
        }
    }
    
}

else
{
    header('Location: ../index.php');
    exit();
}

//mail
if(isset($_POST['mail']))
{
    $mail = trim($_POST['mail']);
    $mail_result = checkmail($mail);
    if($mail_result == 'isnt')
    {
        $_SESSION['mail_info'] = '<span class="erreur">Le mail'.htmlspecialchars($mail, ENT_QUOTES).' n\'est pas valide.</span><br/>';
        $_SESSION['form_mail'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($mail_result == 'exists')
    {
        $_SESSION['mail_info'] = '<span class="erreur">Le mail'.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';
        $_SESSION['form_mail'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($mail_result == 'ok')
    {
        $_SESSION['mail_info'] = '';
        $_SESSION['form_mail'] = $mail;
    }
    
    else if($mail_result == 'empty')
    {
        $_SESSION['mail_info'] = '<span class="erreur">Vous n\'avez pas entré de mail.</span><br/>';
        $_SESSION['form_mail'] = '';
        $_SESSION['erreurs']++;
    }
}

else
{
    header('Location: ../index.php');
    exit();
}

//mail suite
if(isset($_POST['mail_verif']))
{
    $mail_verif = trim($_POST['mail_verif']);
    $mail_verif_result = checkmailS($mail_verif, $mail);
    if($mail_verif_result == 'different')
    {
        $_SESSION['mail_verif_info'] = '<span class="erreur">Le mail de vérification diffère du mail.</span><br/>';
        $_SESSION['form_mail_verif'] = '';
        $_SESSION['erreurs']++;
    }
    
    else
    {
        if($mail_result == 'ok')
        {
            $_SESSION['mail_verif_info'] = '';
            $_SESSION['form_mail_verif'] = $mail_verif;
        }
        
        else
        {
            $_SESSION['mail_verif_info'] = str_replace(' mail', 'mail de vérification', $_SESSION['mail_info']);
            $_SESSION['form_mail_verif'] = '';
            $_SESSION['erreurs']++;
        }
    }
}

else
{
    header('Location: ../index.php');
    exit();
}

//date de naissance
if(isset($_POST['date_naissance']))
{
    $date_naissance = trim($_POST['date_naissance']);
    $date_naissance_result = birthdate($date_naissance);
    if($date_naissance_result == 'format')
    {
        $_SESSION['date_naissance_info'] = '<span class="erreur">Date de naissance au mauvais format ou invalide.</span><br/>';
        $_SESSION['form_date_naissance'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($date_naissance_result == 'tooyoung')
    {
        $_SESSION['date_naissance_info'] = '<span class="erreur">Agagagougougou areuh ? (Vous êtes trop jeune pour vous inscrire ici.)</span><br/>';
        $_SESSION['form_date_naissance'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($date_naissance_result == 'tooold')
    {
        $_SESSION['date_naissance_info'] = '<span class="erreur">Le'.htmlspecialchars($date_naissance, ENT_QUOTES).'n\'existe pas.</span><br/>';
        $_SESSION['form_date_naissance'] = '';
        $_SESSION['erreurs']++;
    }
    
    else if($date_naissance_result == 'ok')
    {
        $_SESSION['date_naissance_info'] = '';
        $_SESSION['form_date_naissance'] = $date_naissance;
    }
    
    else if($date_naissance_result == 'empty')
    {
        $_SESSION['date_naissance_info'] = '<span class="erreur">Vous n\'avez pas entré de date de naissance.</span><br/>';
        $_SESSION['form_date_naissance'] = '';
        $_SESSION['erreurs']++;
    }
}

else
{
    header('Location: ../index.php');
    exit();
}

/****Fin****/
?>
<!--Test des erreurs et envoi-->
            <?php
            if($_SESSION['erreurs'] == 0)
            {
                $insertion = "INSERT INTO membres VALUES(NULL,'".mysql_real_escape_string($pseudo)."','".md5($mdp)."','".mysql_real_escape_string($mail)."',".time().", '".mysql_real_escape_string($date_naissance)."',
                '', '',
                '', '',
                '', '',
                '', '',
                '', '',
                ".time().", 0)";
                
                if(mysql_query($insertion))
                {
                    $queries++;
                    vidersession();
                    $_SESSION['inscrit'] = $pseudo;
                    /*informe qu'il s'est déjà inscrit s'il actualise, si son navigateur bugue avant l'affichage de la page et qu'il recharge la page, etc.*/
                ?>
                <h1>Inscription validée !</h1>
                <p>Nous vous remercions de vous être inscrit sur notre site, votre inscription a été validée !<br/>
                Vous pouvez vous connecter avec vos identifiants <a href="connexion.php">ici</a>.
                </p>
                    <?php
                    }
                
                    else
                    {
                        if(stripos(mysql_error(), $_SESSION['form_pseudo']) !== FALSE) // recherche du pseudo
                        {
                            unset($_SESSION['form_pseudo']);
                            $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
                            $_SESSION['erreurs']++;
                        }
                        
                        if(stripos(mysql_error(), $_SESSION['form_mail']) !== FALSE) //recherche du mail
                        {
                            unset($_SESSION['form_mail']);
                            unset($_SESSION['form_mail_verif']);
                            $_SESSION['mail_info'] = '<span class="erreur">Le mail'.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';
                            $_SESSION['mail_verif_info'] = str_replace('mail','mail de vérification', $_SESSION['mail_info']);
                            $_SESSION['erreurs']++;
                            $_SESSION['erreurs']++;
                        }
                        
                        if($_SESSION['erreurs'] == 0)
                        {
                            $sqlbug = true; //plantage SQL.
                            $_SESSION['erreurs']++;
                        }
                    }
                }
            if($_SESSION['erreurs'] > 0)
            {
                if($_SESSION['erreurs'] == 1) $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu 1 erreur.</span><br/>';
                ?>
                <h1>Inscription non validée.</h1>
                <p>Vous avez rempli le formulaire d'inscription du site et nous vous en remercions, cependant, nous n'avons pas pu valider votre inscription, en voici les raisons :<br/>
                <?php
                    echo $_SESSION['nb_erreurs'];
                    echo $_SESSION['pseudo_info'];
                    echo $_SESSION['mdp_info'];
                    echo $_SESSION['mdp_verif_info'];
                    echo $_SESSION['mail_info'];
                    echo $_SESSION['mail_verif_info'];
                    echo $_SESSION['date_naissance_info'];
                    echo $_SESSION['qcm_info'];
                    echo $_SESSION['captcha_info'];
                
                    if($sqlbug !== true)
                    {
                ?>
                Nous vous proposons donc de revenir à la page précédente pour corriger les erreurs. (Attention, que vous l'ayez correctement remplie ou non, la partie sur la charte et l'image est à refaire intégralement.)</p>
                        <div class="center"><a href="inscription.php">Retour</a>
                        <?php
                            }
                
                            else
                            {
                        ?>
                        Une erreur est survenue dans la base de données, votre formulaire ne peux pas contenir d'erreurs, donc il est possible que le problème vienne de notre côté, réessayez de vous inscrire ou contactez-nous.</p>

                    <div class="center"><a href="inscription.php">Retenter une inscription</a> - <a href="../contact.php">Contactez-nous</a></div>
                    <?php
                        }
                    }
                    ?>
                        </div>

<?php
                if(mysql_query($insertion))
                {
                    if(inscription_mail($mail, $pseudo, $mdp)) $sent = 'Un mail de confirmation vous a été envoyé.';
                    else $sent = 'Un mail de confirmation devait être envoyé, mais son envoi à échoué, vous êtes cependant bien inscrit.';
                    vidersession();
                    $_SESSION['inscrit'] = $pseudo;
                    /* informe qu'il s'est déjà inscrit s'il actualise. Si son navigateur bugue avant l'affichage de la page et qu'il recharge la page, etc...*/
                    ?>
                <h1>Inscription validée !</h1>
                <p>Nous vous remercions de vous être inscrit sur notre site, votre inscription a été validée !<br/>
                Vous pouvez vous connecter avec vos identifiants <a href="connexion.php">ici</a><br/>.
                <?php echo $sent; ?>
</p>
                }
            <?php
            include('../includes/bas.php');
            ?>
<!--fin-->