<?php

switch ($route) {
    case 'admin':
        header('location: /admin/login', true);
        exit();
    case 'admin/login':
        $controller = new \App\Controllers\Views\Admin\Forms\LoginController();
        $controller->handleCalls();
        break;
    case 'admin/logout':
        include PROJECT_ROOT . 'src/Controllers/Logout.php';
        break;
    case 'admin/cruds':
        admin_only();
        $controller = new \App\Controllers\Views\Admin\CrudsController();
        $controller->handleCalls();
        break;
    case 'admin/users':
        admin_only();
        $controller = new \App\Controllers\Views\Admin\Forms\UsersController();
        $controller->handleCalls();
        break;
    case 'admin/movements':
        admin_only();
        $controller = new \App\Controllers\Views\Admin\Forms\MovementsController();
        $controller->handleCalls();
        break;
    case 'admin/categories':
        admin_only();
        $controller = new \App\Controllers\Views\Admin\Forms\CategoriesController();
        $controller->handleCalls();
        break;
    case 'admin/accounts':
        admin_only();
        $controller = new \App\Controllers\Views\Admin\Forms\AccountsController();
        $controller->handleCalls();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}

function admin_only() {
    if (!isset($_SESSION['token']) || $_SESSION['admin'] != true) {
        header("Location: /");
        exit();
    }
}