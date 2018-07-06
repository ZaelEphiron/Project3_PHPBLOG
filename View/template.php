<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?= $title ?></title>
        <link href="public/assets/css/main.css" rel="stylesheet"/>
         <link href="public/assets/css/second.css" rel="stylesheet"/>
    </head>
		
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    
    <body>
        <!-- Header -->
        <div id="titleBar">
            <a href="#header" class="toggle"></a>
            <span class="title">Jean Forteroche</span>
         </div>
			<section id="header">
				<header>
					<span class="image avatar"><img src="Public/images/avatar.jpg" alt="" /></span>
					<h1 id="logo"><a href="#">Jean Forteroche</a></h1>
					<p>Auteur de "Billet simple pour l'Alaska".</p>
                    
                    <h2>Description de l'artiste :</h2>

                    <p>Bonjour et bienvenue sur mon blog !
                    <br />
                    Je suis un artiste écrivain et ceci sera le blog où je posterai, en avant première, les pages de mon nouveau roman en cours de rédaction. Je posterai donc régulièrement les pages, au fûr et à mesure de leur création, les unes-après les autres et comptent sur vous pour commenter ses pages dans le but de recueillir vos idées et ainsi d'améliorer le contenu de ce roman qui s'intitulera : "Billet simple pour l'Alaska".
                    <br />
                    Je vous souhaite à tous une bonne lecture !</p>
				</header>
                
				<nav id="nav">
					<ul>
						<li><a href="index.php?action=listPosts" class="active">Accueil</a></li>
						<li><a href="index.php?action=login">Se connecter</a></li>
                        <?php
                        if (!empty($_SESSION['pseudo'])){
                        ?>
                        <li><a href="index.php?action=logout">Se déconnecter</a></li>
						<?php
                        }
                        ?>
                        <li><a href="index.php?action=inscription">S'inscrire</a></li>
                        <?php
                        if (array_key_exists('role', $_SESSION)){
                            if ($_SESSION['role'] === 'admin'){
                        ?>
						<li><a href="index.php?action=dashboard">Tableau de bord</a></li>
                        <?php
                            }
                        }
                        ?>
					</ul>
				</nav>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Main -->
					<div id="main">
                        
						<!-- One -->
							<section id="one">
								<div class="container">
                                        <?= $content ?>
                                </div>
                        </section>
                </div>
        </div>
        <script src="Public/assets/js/jquery.min.js"></script>
        <script src="Public/assets/js/jquery.scrollzer.min.js"></script>
        <script src="Public/assets/js/jquery.scrolly.min.js"></script>
        <script src="Public/assets/js/skel.min.js"></script>
        <script src="Public/assets/js/util.js"></script>
        <script src="Public/assets/js/main.js"></script>
    </body>
</html>
