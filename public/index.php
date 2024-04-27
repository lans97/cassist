<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['user-id'])) {
    var_dump($_SESSION['user-id']);
} else {
    echo "not set";
}

require "../vendor/autoload.php";
define('PROJECT_ROOT', __DIR__ . '/../');

$basePath = '/';
$requestedUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = implode("/", array_filter(explode('/', $requestedUrl)));

if (strpos($route, 'api') === 0) {
    include PROJECT_ROOT . 'src/Routes/apiRoutes.php';
} elseif (strpos($route, 'admin') === 0) {
    include PROJECT_ROOT . 'src/Routes/adminRoutes.php';
} else {
    include PROJECT_ROOT . 'src/Routes/webRoutes.php';
}