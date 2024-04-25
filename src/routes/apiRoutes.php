<?php
switch ($requestUri) {
    case '/':
        echo '';
        break;
    case '/users':
        echo "test";
        \App\API\Endpoints\handleUsersEndpoint();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}