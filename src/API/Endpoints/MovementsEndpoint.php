<?php
namespace App\API\Endpoints;

class MovementsEndpoint {
    private $_pdo;
    private $_handler;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
        $this->handler = new \App\API\Handlers\MovementsHandler($this->_pdo);
    }

    public function get() {
        if (isset($_GET['movement-id'])) {
            try {
                $movement = $this->_handler->get_movement($_GET['movement-id']);
                $response = [
                    "success" => "true",
                    "data" => $movement,
                    "error" => ""
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => "false",
                    "data" => $movement,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        } else {
            try {
                $movements = $this->_handler->get_movements();
                $response = [
                    "success" => "true",
                    "data" => $movements,
                    "error" => ""
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => "false",
                    "data" => $movements,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        }
    }

    public function post() {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $newUser = $this->_handler->create_movement($requestData);
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
            $updatedUser = $this->_handler->update_movement($requestData);
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
            $movementId = isset($_GET['movement-id']) ? $_GET['movement-id'] : null;
            $this->_handler->delete_movement($movementId);
            http_response_code(204);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array('error' => $e->getMessage()));
        }
    }
    public function handleMovementsEndpoint() {
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