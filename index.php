<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); 

require('App/Autoloader.php');

BlogPHP\App\Autoloader::register();

$router = new BlogPHP\App\Router();
$router->getRoute($_SERVER['REQUEST_URI']);
