<?php

switch ($route) {
    case 'api':
        echo '';
        break;
    case 'api/users':
        $usersEndpoint = new \App\API\Endpoints\UsersEndpoint();
        $usersEndpoint->handleUsersEndpoint();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}