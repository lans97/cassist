<?php namespace App\API\Endpoints;

require_once PROJECT_ROOT . "src/utils/database.service.php";

function handleUsersEndpoint() {
    $pdo = getPDOConnection();
    $userHanler = new \App\API\Handlers\UsersHandler($pdo);
    
    if ($_SERVER['REQUEST METHOD'] === 'GET') {
       $users = $userHanler->getUsers();
       echo json_encode($users);
    } elseif ($_SERVER['REQUEST METHOD'] === 'POST') {
        $requestData = json_decode(file_get_contents('php://input'), true);
        $newUser = $userHanler->createUser($requestData);
        json_encode($newUser);
    } else {
        http_response_code(405);
        echo json_encode(array('error'=> 'Method Not Allowed'));
    }
}