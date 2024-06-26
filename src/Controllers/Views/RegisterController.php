<?php
namespace App\Controllers\Views;

class RegisterController {
    private function index() {
        $title = "Login";
        ob_start();
        include (PROJECT_ROOT . "views/forms/register.php");
        $form = ob_get_clean();
        ob_start();
        include (PROJECT_ROOT . "views/register.php");
        $content = ob_get_clean();
        include (PROJECT_ROOT . "templates/base.php");
    }

    public function handleCalls() {
        if (isset($_SESSION['token'])) {
            header("Location: /home");
            exit();
        }
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