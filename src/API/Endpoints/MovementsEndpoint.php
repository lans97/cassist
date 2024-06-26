<?php
namespace App\API\Endpoints;

class MovementsEndpoint {
    private $_pdo;
    private $_handler;
    
    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
        $this->_handler = new \App\API\Handlers\MovementsHandler($this->_pdo);
    }
    
    public function get() {
        if (isset($_GET['movement-id'])) {
            try {
                $movement = $this->_handler->get_movement($_GET['movement-id']);
                $response = [
                    "success" => true,
                    "data" => $movement,
                ];
                echo json_encode($response);
            } catch (\Exception $e) {
                $response = [
                    "success" => false,
                    "error" => $e->getMessage()
                ];
                echo json_encode($response);
            }
        } elseif (isset($_GET["account-id"])) {
            try {
                $movement = $this->_handler->get_movements_by_account($_GET['account-id']);
                $response = [
                    "success" => true,
                    "data" => $movement,
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => false,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        } elseif (isset($_GET["user-id"])) {
            try {
                $movement = $this->_handler->get_movements_by_user($_GET['user-id']);
                $response = [
                    "success" => true,
                    "data" => $movement,
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => false,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        } elseif (isset($_GET["category-id"])) {
            try {
                $movement = $this->_handler->get_movements_by_category($_GET['category-id']);
                $response = [
                    "success" => true,
                    "data" => $movement,
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => false,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        } else {
            try {
                $movements = $this->_handler->get_movements();
                $response = [
                    "success" => true,
                    "data" => $movements,
                    "error" => ""
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => false,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        }
    }
    
    public function post() {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $this->_handler->create_movement($requestData);
            $response = array(
                "success" => "true",
                "message" => "New movement added",
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
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $updatedMovement = $this->_handler->update_movement($requestData);
            $response = [
                "success" => true,
                "data" => $updatedMovement,
                "error" => ""
            ];
        } catch (\Exception $e) {
            $response = [
                "success" => false,
                "error" => $e->getMessage()
            ];
            echo json_encode($response);
        } catch (\PDOException $e) {
            $response = [
                "success" => false,
                "error" => $e->getMessage()
            ];
            echo json_encode($response);
        }
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