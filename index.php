<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('App/Autoloader.php');

BlogPHP\App\Autoloader::register();

$router = new BlogPHP\App\Router();
$router->getRoute($_SERVER['REQUEST_URI']);
?>

<script src="Public/assets/js/jquery.min.js"></script>
<script src="Public/assets/js/jquery.scrollzer.min.js"></script>
<script src="Public/assets/js/jquery.scrolly.min.js"></script>
<script src="Public/assets/js/skel.min.js"></script>
<script src="Public/assets/js/util.js"></script>
<script src="Public/assets/js/main.js"></script>