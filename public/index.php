<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('PROJECT_ROOT', __DIR__ . '/../');

$basePath = '/';
$requestedUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = implode("/", array_filter(explode('/', $requestedUrl)));

var_dump($route);

if (strpos($route, 'api') === 0) {
    include PROJECT_ROOT . 'src/routes/apiRoutes.php';
} elseif (strpos($route, 'admin') === 0) {
    include PROJECT_ROOT . 'src/routes/adminRoutes.php';
} else {
    include PROJECT_ROOT . 'src/routes/webRoutes.php';
}