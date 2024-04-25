<?php

switch ($_SERVER['REQUEST_URI']) {
    case '/admin':
        $controller = new \App\Controller\LoginController();
        $controller->index();
        break;
    case '/admin/users':
        break;
    case '/admin/movements':
        break;
    case '/admin/movement-categories':
        break;
    case '/admin/accounts':
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}