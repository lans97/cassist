<?php
require_once PROJECT_ROOT . "src/Utils/database.service.php";

switch ($route) {
    case 'api':
        echo '';
        break;
    case 'api/users':
        $endpoint = new \App\API\Endpoints\UsersEndpoint(getPDOConnection());
        $endpoint->handleUsersEndpoint();
        break;
    case 'api/accounts':
        $endpoint = new \App\API\Endpoints\AccountsEndpoint(getPDOConnection());
        $endpoint->handleAccountsEndpoint();
        break;
    case 'api/categories':
        $endpoint = new \App\API\Endpoints\CategoriesEndpoint(getPDOConnection());
        $endpoint->handleCategoriesEndpoint();
        break;
    case 'api/movements':
        $endpoint = new \App\API\Endpoints\MovementsEndpoint(getPDOConnection());
        $endpoint->handleMovementsEndpoint();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}