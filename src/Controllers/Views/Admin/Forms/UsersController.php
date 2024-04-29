<?php namespace App\Controllers\Views\Admin\Forms;

class UsersController {
    public function index() {
        include '../templates/header.php';
        include '../views/admin/users.php';
        include '../templates/footer.php';
    }

    public function handleCalls() {
        if (isset($_SESSION['token'])){
            header("Location: /admin/cruds");
            exit();
        }
        switch ($_SERVER['REQUEST_METHOD']){
            case 'GET':
                $this->index();
                break;
            default:
                http_response_code(405);
                echo 'Not Allowed';
        }
    }
}