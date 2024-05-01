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
        if (!$_SESSION['admin']){
            header('Location: /error/403', true);
        }
        $controller = new \App\Controllers\Views\Admin\CrudsController();
        $controller->handleCalls();
        break;
    case 'admin/users':
        $controller = new \App\Controllers\Views\Admin\Forms\UsersController();
        $controller->handleCalls();
        break;
    case 'admin/movements':
        $controller = new \App\Controllers\Views\Admin\Forms\MovementsController();
        $controller->handleCalls();
        break;
    case 'admin/categories':
        $controller = new \App\Controllers\Views\Admin\Forms\CategoriesController();
        $controller->handleCalls();
        break;
    case 'admin/accounts':
        $controller = new \App\Controllers\Views\Admin\Forms\AccountsController();
        $controller->handleCalls();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}