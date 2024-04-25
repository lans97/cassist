<?php
switch ($route) {
    case 'api':
        echo '';
        break;
    case 'api/users':
        \App\API\Endpoints\handleUsersEndpoint();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}