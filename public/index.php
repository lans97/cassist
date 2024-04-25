<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('PROJECT_ROOT', __DIR__ . '/../');

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

var_dump($requestUri);

if (strpos($requestUri, '/api') === 0) {
    include PROJECT_ROOT . 'src/routes/apiRoutes.php';
} elseif (strpos($requestUri, '/admin') === 0) {
    include PROJECT_ROOT . 'src/routes/adminRoutes.php';
} else {
    include PROJECT_ROOT . 'src/routes/webRoutes.php';
}