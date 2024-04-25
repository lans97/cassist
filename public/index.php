<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('PROJECT_ROOT', __DIR__ . '/../');

require_once PROJECT_ROOT . 'routes/webRoutes.php';
require_once PROJECT_ROOT . 'routes/adminRoutes.php';
require_once PROJECT_ROOT . 'routes/apiRoutes.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($requestUri, '/api/') === 0) {
    include PROJECT_ROOT . 'routes/apiRoutes.php';
} elseif (strpos($requestUri, '/admin/') === 0) {
    include PROJECT_ROOT . 'routes/adminRoutes.php';
} else {
    include PROJECT_ROOT . 'routes/webRoutes.php';
}