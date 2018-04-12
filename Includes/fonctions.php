<?php
/*
Page fonctions.php

Contient quelques fonctions globales.

Quelques indications : (utiliser l'outil de recherche et rechercher les mentions donnÃ©es)

Liste des fonctions :
--------------------------
sqlquery($requete,$number)
connexionbdd()
actualiser_session()
vider_cookie()
--------------------------


Liste des informations/erreurs :
--------------------------
Mot de passe de session incorrect
Mot de passe de cookie incorrect
L'id de cookie est incorrect
--------------------------
*/

function sqlquery($requete, $number)
{
    $query = mysql_query($requete) or exit('Erreur SQL : '.mysql_error().'Ligne :'. __LINE__ .'.'); //requête
    queries();
    
    /*
    Deux cas possibles ici :
    Soit on sait qu'on a qu'une seule entrée qui sera retournée par SQL, donc on met $number à 1
    Soit one ne sait pas combien seront retournées, on met alors $number à 2.
    */
    
    if($number == 1)
    {
        $query1 = mysql_fetch_assoc($query);
        mysql_free_result($query);
        /* mysql_free_result($query) libère le contenu de $query, je le fais par principe, mais c'est pas indispensable.*/
        return $query1;
    }
    
    else if($number == 2)
    {
        while($query1 = mysql_fetch_assoc($query))
        {
            $query2[] = $query1;
            /* On met $query1 qui est un array dans $query2 qui est un array. Ça fait un array d'arrays :o */
        }
        mysql_free_result($query);
        return $query2;
    }
    
    else //Erreur
    {
        exit('Argument de sqlquery non renseigné ou incorrect.');
    }

function queries($num = 1)
{
    global $queries;
    $queries = $queries + intval($num);
}  

function connexionbdd()
{
    //Définition des variables de connexion à la base de données
    $bd_nom_serveur='localhost';
    $bd_login='root';
    $bd_mot_de_passe='';
    $bd_nom_bd='espace_membre';
        
    //Connexion à la base de données
    mysql_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
    mysql_select_db($bd_nom_bd);
    mysql_query("set names 'utf8'");
    }
    
function actualiser_session()
{
    if(isset($_SESSION['membre_id']) && intval($_SESSION['membre_id']) !=0)
//Vérification id
    {
        //utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
        $retour = sqlquery("SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_id = ".intval($_SESSION['membre_id']), 1);
            
        //Si la requête a un résultat (c'est à dire si l'id existe dans la table membres)
        if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
            {
                if($_SESSION['membre_mdp'] != $retour['membre_mdp'])
                {
                    //Dehors vilain pas beau !
                    $informations = Array(/*Mot de passe de session incorrect*/
                                    true,
                                    'Session invalide',
                                    'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
                                    '',
                                    'membres/connexion.php',
                                    3
                                    );
                    require_once('../information.php');
                    vider_cookie();
                    session_destroy();
                    exit();
                }
                
                else
                {
                    //Validation de la session.
                    $_SESSION['membre_id'] = $retour['membre_id'];
                    $_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
                    $_SESSION['membre_mdp'] = $retour['membre_mdp'];
                }
            }
        }
        
        else //On vérifie les cookies et sinon pas de session
        {
            if(isset($_COOKIE['membre_id']) && isset($_COOKIE['membre_mdp']))
                //S'il en manque un, pas de session
            {
                if(intval($_COOKIE['membre_id']) != 0)
                {
                    //idem qu'avec les $_SESSION
                    $retour = sqlquery("SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_id = ".intval($_COOKIE['membre_id']), 1);
                    
                    if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
                    {
                        //Dehors vilain tout moche !
                        $informations = Array(/*Mot de passe de cookie incorrect*/
                                            true,
                                            'Mot de passe cookie erroné',
                                            'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.',
                                            '',
                                            'membres/connexion.php',
                                            3
                                            );
                        require_once('../information.php');
                        vider_cookie();
                        session_destroy();
                        exit();
                    }
                    
                    else
                    {
                        //Bienvenue :D
                        $_SESSION['membre_id'] = $retour['membre_id'];
                        $_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
                        $_SESSION['membre_mdp'] = $retour['membre_mdp'];
                    }
                }
            }
            
            else // cookie invalide, erreur plus suppresion des cookies.
            {
                $informations  = Array(/*L'id de cookie est incorrrect*/
                                    true,
                                    'Cookie invalide',
                                    'Le cookie conservant votre id est corrompu,
                                    il va donc être détruit vous devez vous reconnecter.',
                                    '',
                                    'membres/connexion.php',
                                    3
                                    );
                require_once('../information.php');
                vider_cookie();
                session_destroy();
                exit();  
            }
        }
    
        else
        {
            //Fonction de suppression de toutes les variables de cookie.
            if(isset($_SESSION['membre_id'])) unset($_SESSION['membre_id']);
            vider_cookie();
        }
    }
}

function vider_cookie()
{
    foreach($_COOKIE as $cle => $element)
    {
        setcookie($cle, '', time()-3600);
    }
}

function checkpseudo($pseudo)
{
    if($pseudo == '') return 'empty';
    else if(strlen($pseudo) < 3) return 'tooshort';
    else if(strlen($pseudo) > 32) return 'toolong';
    
    else
    {
        $result = sqlquery("SELECT COUNT(*) AS nbr FROM membres WHERE membre_pseudo= '".mysql_real_escape_string($pseudo)."'",1);
        global $queries;
        $queries++;
        
        if($result['nbr'] > 0) return 'exists';
        else return 'ok';
    }
}

function checkmdp($mdp)
{
    if($mdp == '') return 'empty';
    else if(strlen($mdp) < 4) return 'tooshort';
    else if(strlen($mdp) > 50) return 'toolong';
    
    else
    {
        if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
        else if(!preg_match('[A-Z]{1,}#', $mdp)) return 'noupcap';
        else return 'ok';
    }
}

function checkmdps($mdp, $mdp2)
{
    if($mdp != $mdp2 && $mdp != '' && $mdp2 !='') return 'different';
    else return checkmdp($mdp);
}

function checkmail($email)
{
    if($email == '') return 'empty';
    else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9.\-]{2,}\.[a-z]{2,4}$#is' $email)) return 'isnt';
    
    else
    {
        $result = sqlquery("SELECT COUNT(*) AS nbr FROM membres WHERE membre_mail = '".mysql_real_escape_string($email)."'",1);
        global $queries;
        $queries++;
        
        if($result['nbr'] > 0) return 'exists';
        else return 'ok';
    }
}

function checkmailS($email, $email2)
{
    if($email != $email2 && $email != '' && $email2 != '') return 'different';
    else return 'ok';
}

function birthdate($date)
{
    if($date == '') return 'empty';
    
    else if(substr_count($date, '/') != 2) return 'format';
    else
    {
        $DATE = explode('/', $date);
        if(date('Y') - $DATE[2] <= 4) return 'tooyoung';
        else if(date('Y') - $DATE[2] >= 135) return 'tooold';
        
        else if($DATE[2]%4 == 0)
        {
            $maxdays = Array('31', '29', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
            if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
            else return 'ok';
        }
        
        else
        {
            $maxdays = Array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
            if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
            else return 'ok';
        }
    }
}

function vidersession()
{
    foreach($_SESSION as $cle => $element)
    {
        unset($_SESSION[$cle]);
    }
}

function inscription_mail($mail, $pseudo, $passe)
{
    $to = $mail;
    $subject = 'Inscription sur '.TITRESITE.' - '.$pseudo;
    $message = '<html>
                    <head>
                        <title></title>
                    </head>
                    
                    <body>
                        <div>Bienvenue sur '.TITRESITE.' ! <br/>
                        Vous avez complété une inscription avec le pseudo'.htmlspecialchars($pseudo, ENT_QUOTES).'à l\'instant.<br/>
                        
                        Votre mot de passe est : '.htmlspecialchars($passe, ENT_QUOTES).'.<br/>
                        Veillez à le garder secret et à ne pas l\'oublier.
                        <br/><br/>
                        
                        En vous remerciant.<br/><br/>
                        Moi - Webmaster de '.TITRESITE.'
                    </body>
                <html>';
//hearders principaux.
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
//headers supplémentaires
$headers .= 'From: "Mon super site" <contact@supersite.com>' . "\r\n";
$headers .= 'Cc: "Duplicata" <duplicata@supersite.com>' . "\r\n";
$headers .= 'Reply-To: "Membres" <membres@supersite.com>' . "\r\n";

$mail = mail($to, $subject, $message, $headers); // marche
    
if($mail) return true;
return false;
}

function get($type) //je ne me suis pas foulé
    
    if($type == 'nb_membres')
    {
            $count = sqlquery("SELECT COUNT(*) AS nbr FROM membres", 1);
            return $count['nbr'];
    }

    else if($type == 'connectes')
    {
            $count = sqlquery("SELECT COUNT(*) AS nbr FROM connectes", 1);
            return $count['nbr'];
    }

    else
    {
            return 0;
    }
}

function mepd($date)
{
        if(intval($date) == 0) return $date;
    
        $tampon = time();
        $diff = $tampon - $date;
    
        $dateDay = date('d', $date);
        $tamponDay  = date('d', $tampon);
        $diffDay = $tamponDay - $dateDay;
    
        else if($diff < 600 && $diffDay == 0)
        {
                return 'Il y a '.floor($diff/60). 'm et '.floor($diff%60).'s';
        }
    
        else if($diff < 3600 && $diffDay == 0)
        {
                return 'Il y a '.floor($diff/60).'m';
        }
    
        else if($diff < 7200 && $diffDay == 0)
        {
                return 'Il y a '.floor($diff/3600).'h et '.floor(($diff%3600)/60).'m';
        }

        else if($diff < 24*3600 && $diffDay == 0)
        {
                return 'Aujourd\'hui à '.date('H\hi', $date);
        }
    
        else if($diff < 48*3600 && $diffDay == 1)
        {
                return 'Hier à '.date('H\hi', $date);
        }
    
        else
        {
                return 'Le '.date('d/m/Y', $date).' à '.date('h\hi', $date).'.';
        }
}

function updateConnectes($id)
{
        $ip = getIp();
        if($id != -1)
        {
                $id = $_SESSION['membre_id'];
                $additionnal = 1; //La variable à mettre dans connectes_membre
        }
    
        else
        {
                $additionnal = $ip;
        }
    
        mysql_query("DELETE FROM connectes WHERE connectes_actualisation < ".(time()-300)) or exit(mysql_error()); //MàJ générale des connectés
        mysql_query("INSERT INTO connectes VALUES(".$id.", '".$ip."','".$additionnal."',".time().")
        ON DUPLICATE KEY UPDATE connectes_actualisation=".time().",connectes_ip'".$ip."'") or exit(mysql_error()); //tiens, tiens, ON DUPLICATE... :O
        queries(2);
}

function getIp()
{
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else return $_SERVER['REMOTE_ADDR'];
}

function actualiser_session()
{
        if(isset($_SESSION['membre_id']) && intval($_SESSION['membre_id']) != 0) //Vérification id
        {
                //utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
            $retour = sqlquery("SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_id = ".intval($_SESSION['membre_id']),1);
            
                        //Si la requête a un résultat (id est : si l'id existe dans la table membres)
                        if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
                        {
                            if($_SESSION['membre_mdp'] != $retour['membre_mdp'])
                            {
                                    //Dehors vilain pas beau !
                                    $informations = Array(/*Mot de passe de session incorrect*/
                                                        true,
                                    
                                                        'Session invalide',
                                    
                                                        'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
                                                        '',
                                                        'membres/connexion.php',
                                                        3
                                                        );
                                require_once('../information.php');
                                vider_cookie();
                                session_destroy();
                                exit();
                            }
                            
                            else
                            {
                                    //Validation de la session.
                                    $_SESSION['membre_id'] = $retour['membre_id'];
                                    $_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
                                    $_SESSION['membre_mdp'] = $retour['membre_mdp'];
                                    mysql_query("UPDATE membres SET membre_derniere_visite = ".time()."WHERE membre_id =".$_SESSION['membre_id']) or exit(mysql_error());
                                    queries();
                            }
                    }
        }
    
        else //On vérifie les cookies et sinon pas de session
        {
                if(isset($_COOKIE['membre_id']) && isset($_COOKIE['membre_mdp'])) //S'il en manque un, pas de session.
                    
                    if(intval($_COOKIE['membre_id']) != 0)
                    {
                            //idem qu'avec les $_SESSION
                            $retour = sqlquery("SELECT membre_id,
                            membre_pseudo, membre mdp FROM membres WHERE membre_id =".intval($_COOKIE['membre_id']), 1);
                        
                            if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
                            {
                                    if($_COOKIE['membre_mdp'] != $retour['membre_mdp'])
                                    {
                                        //Dehors vilain tout moche !
                                        $informations = Array(/*Mot de passe cookie incorrect*/
                                        
                                        true,
                                        
                                        'Mot de passe cookie erroné',
                                        'Le mot de passe conservé sur votre cookie est incorrect, vous devez vous reconnecter.',
                                        '',
                                        'membres/connexion.php',
                                        3
                                        );
                                    require_once('../information.php');
                                    vider_cookie();
                                    session_destroy();
                                    exit();
                                    }
                                    
                                    else
                                    {
                                            //Bienvenue :D
                                            $_SESSION['membre_id'] = $retour['membre_id'];
                                            $_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
                                            mysql_query("UPDATE membres SET membre_dernière_visite = ".time()."WHERE membre_id = ".$_SESSION['membre_id']) or exit(mysql_error());
                                            queries();
                                    }
                            }
                    }
            
                    else //cookie invalide, erreur plus suppresion des cookies.
                    {
                        $informations = Array(/*l'id de cookie est incorrect*/
                                            true,
                                            'Cookie invalide',
                                            'Le cookie conservant votre id est corrompu, il va donc être détruit, vous devez vous reconnecter.',
                                            '',
                                            'membres/connexion.php',
                                            3
                                            );
                        require_once('../information.php');
                        vider_cookie();
                        session_destroy();
                        exit();
                    }
           
        }
        
        else
        {
                //Fonction de suppression de toutes les variables de cookie.
                if(isset($_SESSION['membre_id'])) unset($_SESSION['membre_id']);
                vider_cookie();
        }
    }

    if(isset($_SESSION['membre_id'])) $id = $_SESSION['membre_id'];
    else $id = -1;
    updateconnectes($id);
}

function age($birth)
{
        $DATE = intArray(explode('/', $birth));
        $try = mktime(0, 0, 0, $DATE[1], $DATE[0], date('Y'));
        if(time() >= $try) $age = date('Y') - $DATE[2];
        else $age = date('Y') - $DATE[2] - 1;
    
        return $age;
}

function intArray($array)
{
        foreach($Array as $cle => $element)
        {
                $Array[$cle] = intval($element);
        }
    
        return $Array;
}
?>
