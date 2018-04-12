<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('app/router.php');

$router = new BlogPHP\App\Router();
$router->getRoute($_SERVER['REQUEST_URI']);
