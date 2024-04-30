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
    case 'login':
        $controller = new App\Controllers\Views\LoginController();
        $controller->handleCalls();
        break;
    case 'register':
        $controller = new App\Controllers\Views\Forms\RegisterController();
        $controller->handleCalls();
        break;
    case 'about':
        $controller = new App\Controllers\Views\AboutController();
        $controller->handleCalls();
        break;
    case 'logout':
        include PROJECT_ROOT . 'src/Controllers/Logout.php';
        break;
    case 'error/403':
        http_response_code(403);
        include PROJECT_ROOT . "errors/403.php";
        break;
    default:
        http_response_code(404);
        include PROJECT_ROOT . "errors/404.php";
        break;
}