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
    case 'register':
        $controller = new App\Controllers\Views\RegisterController();
        $controller->handleCalls();
        break;
    case 'about':
        $controller = new App\Controllers\Views\AboutController();
        $controller->handleCalls();
        break;
    case 'logout':
        include PROJECT_ROOT . 'src/Controllers/Logout.php';
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}