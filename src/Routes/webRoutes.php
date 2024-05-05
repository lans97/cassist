<?php
switch ($route) {
    case '':
        $controller = new App\Controllers\Views\LandingController();
        $controller->handleCalls();
        break;
    case 'register':
        $controller = new App\Controllers\Views\RegisterController();
        $controller->handleCalls();
        break;
    case 'login':
        $controller = new App\Controllers\Views\LoginController();
        $controller->handleCalls();
        break;
    case 'about':
        $controller = new App\Controllers\Views\AboutController();
        $controller->handleCalls();
        break;
    case 'logout':
        login_required();
        include PROJECT_ROOT . 'src/Controllers/Logout.php';
        break;
    case 'home':
        login_required();
        $controller = new App\Controllers\Views\Main\HomeController();
        $controller->handleCalls();
        break;
    case "accounts":
        login_required();
        $controller = new App\Controllers\Views\Main\AccountsController();
        $controller->handleCalls();
        break;
    case "categories":
        login_required();
        $controller = new App\Controllers\Views\Main\CategoriesController();
        $controller->handleCalls();
        break;
    case "history":
        login_required();
        $controller = new App\Controllers\Views\Main\HistoryController();
        $controller->handleCalls();
        break;
    case 'error/403':
        http_response_code(403);
        $content = file_get_contents(PROJECT_ROOT . "errors/403.php");
        include PROJECT_ROOT . "templates/base.php";
        break;
    default:
        http_response_code(404);
        $content = file_get_contents(PROJECT_ROOT . "errors/404.php");
        include PROJECT_ROOT . "templates/base.php";
        break;
}

function login_required() {
    if (!isset($_SESSION["token"])) {
        header("Location: /");
    }
}