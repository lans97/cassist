<?php
namespace App\API\Endpoints;

class UsersEndpoint {
    private $_pdo;
    private $_handler;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function get() {
        $handler = new \App\API\Handlers\UsersHandler($this->_pdo);
        if (isset($_GET['user-id'])) {
            try {
                $user = $handler->get_user($_GET['user-id']);
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
                $users = $handler->get_users();
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
        $handler = new \App\API\Handlers\UsersHandler($this->_pdo);
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $handler->create_user($requestData);
            $response = array(
                "success" => true,
                "message" => "You have been registered",
            );
            echo json_encode($response);
        } catch (\Exception $e) {
            $response = array(
                "success" => false,
                "error" => $e->getMessage(),
            );
            echo json_encode($response);
        } catch (\PDOException $e) {
            $response = array(
                "success" => false,
                "error" => $e->getMessage(),
            );
            echo json_encode($response);
        }
    }

    public function put() {
        $handler = new \App\API\Handlers\UsersHandler($this->_pdo);
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $updatedUser = $handler->update_user($requestData);
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
        echo json_encode($response);
    }

    public function delete() {
        $handler = new \App\API\Handlers\UsersHandler($this->_pdo);
        try {
            $userId = isset($_GET['user-id']) ? $_GET['user-id'] : null;
            $handler->delete_user($userId);
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