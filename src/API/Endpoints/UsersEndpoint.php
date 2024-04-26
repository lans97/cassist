<?php
namespace App\API\Endpoints;

require_once PROJECT_ROOT . "src/Utils/database.service.php";


class UsersEndpoint
{
    public function handleUsersEndpoint()
    {
        $pdo = getPDOConnection();
        $userHandler = new \App\API\Handlers\UsersHandler($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['user-id'])) {
                $user = $userHandler->getUser($_GET['user-id']);
                if ($user) {
                    $response = [
                        "success" => "true",
                        "data" => $user,
                        "error" => ""
                    ];
                } else {
                    $response = [
                        "success" => "false",
                        "data" => $user,
                        "error" => "User not found"
                    ];
                }
                echo json_encode($response);
            } else {
                $users = $userHandler->getUsers();
                if ($users) {
                    $response = [
                        "success" => "true",
                        "data" => $users,
                        "error" => ""
                    ];
                } else {
                    $response = [
                        "success" => "false",
                        "data" => $users,
                        "error" => "User not found"
                    ];
                }
                echo json_encode($response);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $newUser = $userHandler->createUser($requestData);
            json_encode($newUser);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $requestData = json_decode(file_get_contents('php://input'), true);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $userId = isset($_GET['user-id']) ? $_GET['user-id'] : null;
            if ($userId !== null) {
                $success = $userHandler->deleteUser($userId);
                if ($success) {
                    http_response_code(204);
                } else {
                    http_response_code(404);
                    echo json_encode(array('error' => 'User not found'));
                }
            }
        } else {
            http_response_code(405);
            echo json_encode(array('error' => 'Method Not Allowed'));
        }
    }
}