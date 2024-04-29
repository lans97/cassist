<?php
namespace App\API\Endpoints;

class CategoriesEndpoint {
    private $_pdo;
    private $_handler;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
        $this->handler = new \App\API\Handlers\CategoriesHandler($this->_pdo);
    }

    public function get() {
        if (isset($_GET['category-id'])) {
            try {
                $category = $this->_handler->get_category($_GET['category-id']);
                $response = [
                    "success" => "true",
                    "data" => $category,
                    "error" => ""
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => "false",
                    "data" => $category,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        } else {
            try {
                $categories = $this->_handler->get_categories();
                $response = [
                    "success" => "true",
                    "data" => $categories,
                    "error" => ""
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => "false",
                    "data" => $categories,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        }
    }

    public function post() {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $newUser = $this->_handler->create_category($requestData);
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
            $updatedUser = $this->_handler->update_category($requestData);
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
            $categoryId = isset($_GET['category-id']) ? $_GET['category-id'] : null;
            $this->_handler->delete_category($categoryId);
            http_response_code(204);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array('error' => $e->getMessage()));
        }
    }
    public function handleCategoriesEndpoint() {
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