<?php
switch ($route) {
    case '':
        $controller = new App\Controllers\Views\HomeController();
        $controller->index();
        break;
    case 'about':
        echo 'About Us';
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}