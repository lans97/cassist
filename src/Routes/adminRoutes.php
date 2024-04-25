<?php

switch ($route) {
    case 'admin':
        echo 'admin home';
        $controller = new App\Controllers\Views\Admin\LoginController();
        $controller->index();
        break;
    case 'admin/users':
        echo 'admin users';
        break;
    case 'admin/movements':
        echo 'admin movements';
        break;
    case 'admin/movement-categories':
        echo 'admin movement-categories';
        break;
    case 'admin/accounts':
        echo 'admin accounts';
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}