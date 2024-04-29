<?php
require_once PROJECT_ROOT . "src/Utils/database.service.php";

switch ($route) {
    case 'api':
        echo '';
        break;
    case 'api/users':
        $usersEndpoint = new \App\API\Endpoints\UsersEndpoint(getPDOConnection());
        $usersEndpoint->handleUsersEndpoint();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}