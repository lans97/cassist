<?php namespace App\Controllers\Views\Forms;

class LoginController {
    private function index() {
        $title = "Login";
        $content = file_get_contents(PROJECT_ROOT . "/views/forms/login.php");
        include (PROJECT_ROOT . "templates/base.php");
    }
    
    public function handleCalls() {
        if (isset($_SESSION['token'])){
            header("Location: /home");
            exit();
        }
        switch ($_SERVER['REQUEST_METHOD']){
            case 'GET':
                $this->index();
                break;
            default:
                http_response_code(405);
                echo 'Not Allowed';
                break;
        }
    }
}