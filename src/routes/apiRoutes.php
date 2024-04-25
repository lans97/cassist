<?php
switch ($_SERVER['REQUEST_URI']) {
    case '/':
        echo '';
        break;
    case '/users':
        \App\API\Endpoints\handleUsersEndpoint();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}