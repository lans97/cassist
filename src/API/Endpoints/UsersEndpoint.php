<?php
namespace App\API\Endpoints;

class UsersEndpoint {
    private $_pdo;
    private $_handler;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
        $this->handler = new \App\API\Handlers\UsersHandler($this->_pdo);
    }

    public function get() {
        if (isset($_GET['user-id'])) {
            try {
                $user = $this->_handler->get_user($_GET['user-id']);
                $response = [
                    "success" => "true",
                    "data" => $user,
                    "error" => ""
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => "false",
                    "data" => $user,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        } else {
            try {
                $users = $this->_handler->get_users();
                $response = [
                    "success" => "true",
                    "data" => $users,
                    "error" => ""
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => "false",
                    "data" => $users,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        }
    }

    public function post() {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $newUser = $this->_handler->create_user($requestData);
            $response = [
                "success" => "true",
                "data" => $newUser,
                "error" => ""
            ];
        } catch (\Exception $e) {
            $response = [
                "success" => "false",
                "data" => $newUser,
                "error" => $e->getMessage()
            ];
        }
        json_encode($response);
    }

    public function put() {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $updatedUser = $this->_handler->update_user($requestData);
            $response = [
                "success" => "true",
                "data" => $updatedUser,
                "error" => ""
            ];
        } catch (\Exception $e) {
            $response = [
                "success" => "false",
                "data" => $updatedUser,
                "error" => $e->getMessage()
            ];
        }
        json_encode($response);
    }

    public function delete() {
        try {
            $userId = isset($_GET['user-id']) ? $_GET['user-id'] : null;
            $this->_handler->delete_user($userId);
            http_response_code(204);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array('error' => $e->getMessage()));
        }
    }
    public function handleUsersEndpoint() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->get();
                break;
            case 'POST':
                $this->post();
                break;
            case 'PUT':
                $this->put();
                break;
            case 'DELETE':
                $this->delete();
                break;
            default:
                http_response_code(405);
                echo json_encode(array('error' => 'Method Not Allowed'));
                break;
        }
    }
}