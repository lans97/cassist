<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "entrypoint<br>";

define('PROJECT_ROOT', __DIR__ . '/../');


require_once PROJECT_ROOT . 'src/routes/webRoutes.php';
require_once PROJECT_ROOT . 'src/routes/adminRoutes.php';
require_once PROJECT_ROOT . 'src/routes/apiRoutes.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($requestUri, '/api/') === 0) {
    include PROJECT_ROOT . 'src/routes/apiRoutes.php';
} elseif (strpos($requestUri, '/admin/') === 0) {
    include PROJECT_ROOT . 'src/routes/adminRoutes.php';
} else {
    include PROJECT_ROOT . 'src/routes/webRoutes.php';
}