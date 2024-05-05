<?php
namespace App\Controllers\Views;

class LoginController {
    private function index() {
        $title = "Login";
        ob_start();
        include (PROJECT_ROOT . "views/forms/login.php");
        $form = ob_get_clean();
        ob_start();
        include (PROJECT_ROOT . "views/login.php");
        $content = ob_get_clean();
        include (PROJECT_ROOT . "templates/base.php");
    }

    public function handleCalls() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->index();
                break;
            case 'POST':
                $loginForm = new \App\Controllers\Views\Forms\LoginController();
                $loginForm->handleCalls();
                break;
            default:
                http_response_code(405);
                echo 'Not Allowed';
                break;
        }
    }
}