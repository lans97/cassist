<?php namespace App\Controllers\Views;

class LandingController {
    private function index() {
        $title = "Welcome";
        $content = file_get_contents(PROJECT_ROOT . "views/landing.php");
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
        }
    }
}