<?php

switch ($route) {
    case 'admin':
        header('location: /admin/login', true);
        exit();
    case 'admin/login':
        $controller = new \App\Controllers\Views\Admin\LoginController();
        $controller->index();
        break;
    case 'admin/cruds':
        $controller = new \App\Controllers\Views\Admin\CrudsController();
        $controller->index();
        break;
    case 'admin/users':
        $controller = new \App\Controllers\Views\Admin\UsersController();
        $controller->index();
        break;
    case 'admin/movements':
        $controller = new \App\Controllers\Views\Admin\MovementsController();
        $controller->index();
        break;
    case 'admin/movement-categories':
        $controller = new \App\Controllers\Views\Admin\MovementCategoriesController();
        $controller->index();
        break;
    case 'admin/accounts':
        $controller = new \App\Controllers\Views\Admin\AccountsController();
        $controller->index();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}