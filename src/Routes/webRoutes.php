<?php
switch ($route) {
    case '':
        $controller = new App\Controllers\Views\LandingController();
        $controller->handleCalls();
        break;
    case 'home':
        $controller = new App\Controllers\Views\HomeController();
        $controller->handleCalls();
        break;
    case 'about':
        echo 'About Us';
        break;
    case 'logout':
        include PROJECT_ROOT . 'controllers/Logout.php';
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}