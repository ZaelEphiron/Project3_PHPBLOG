<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?= $title ?></title>
       <!-- 
        <link href="public/css/bootstrap.css" rel="stylesheet"/>
        <link href="public/css/style.css" rel="stylesheet"/>
        -->
        <link href="public/assets/css/main.css" rel="stylesheet"/>
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
					<span class="image avatar"><img src="images/avatar.jpg" alt="" /></span>
					<h1 id="logo"><a href="#">Jean Forteroche</a></h1>
					<p>Auteur de "Billet simple pour l'Alaska".</p>
				</header>
				<nav id="nav">
					<ul>
						<li><a href="index.php?action=listPosts" class="active">Accueil</a></li>
						<li><a href="index.php?action=login">Se connecter</a></li>
						<li><a href="index.php?action=inscription">S'inscrire</a></li>
                        <?php
                        if ($_SESSION['role'] == 'admin'){
                        ?>
						<li><a href="index.php?action=dashboard">Tableau de bord</a></li>
                        <?php
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
									<header class="major">
                                        <?= $content ?>
                                    </header>
                                </div>
                        </section>
                </div>
        </div>        
    </body>
</html>
