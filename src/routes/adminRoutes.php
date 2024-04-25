<?php

switch ($_SERVER['REQUEST_URI']) {
    case '/admin/login':
        echo 'Welcome to the homepage';
        break;
    case '/admin':
        echo 'About Us';
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