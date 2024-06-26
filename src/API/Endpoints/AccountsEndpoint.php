<?php
namespace App\API\Endpoints;

class AccountsEndpoint {
    private $_pdo;
    private $_handler;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
        $this->_handler = new \App\API\Handlers\AccountsHandler($this->_pdo);
    }

    public function get() {
        if (isset($_GET['account-id'])) {
            try {
                $account = $this->_handler->get_account($_GET['account-id']);
                $response = [
                    "success" => true,
                    "data" => $account,
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => false,
                    "error" => $e->getMessage()
                ];
            }
            echo json_encode($response);
        } elseif (isset($_GET['user-id'])) {
            try {
                $accounts = $this->_handler->get_accounts_by_user($_GET['user-id']);
                $response = [
                    "success" => true,
                    "data" => $accounts,
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
                $accounts = $this->_handler->get_accounts();
                $response = [
                    "success" => true,
                    "data" => $accounts,
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
            $this->_handler->create_account($requestData);
            $response = array(
                "success" => true,
                "data" => "New account added",
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
            $updatedAccount = $this->_handler->update_account($requestData);
            $response = [
                "success" => true,
                "data" => $updatedAccount,
            ];
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

    public function delete() {
        try {
            $accountId = isset($_GET['account-id']) ? $_GET['account-id'] : null;
            $this->_handler->delete_account($accountId);
            http_response_code(204);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array('error' => $e->getMessage()));
        }
    }
    public function handleAccountsEndpoint() {
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