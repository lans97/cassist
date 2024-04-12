<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$basePath = '/';
$requestedUrl = $_SERVER['REQUEST_URI'];
$route = str_replace($basePath, '', $requestedUrl);

switch ($route) {
    case '':
    case '/':
    case 'home':
        include '../controllers/HomeController.php';
        break;
    case 'calculator':
        include '../controllers/CalculatorController.php';
        break;
    default:
        http_response_code(404);
        include '../errors/404.php';
        break;
}

?>