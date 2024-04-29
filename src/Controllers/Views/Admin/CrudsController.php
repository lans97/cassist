<?php namespace App\Controllers\Views\Admin;

class CrudsController {
    private function index() {
        $title = "Models";
        $content = file_get_contents(PROJECT_ROOT . "views/admin/cruds.php");
        include (PROJECT_ROOT . "templates/admin/base.php");
    }

    private function handlePost() {
        header("Location: admin/cruds");
        exit();
    }
    public function handleCalls() {
        if (!isset($_SESSION['token'])){
            header("Location: /");
            exit();
        }
        switch ($_SERVER['REQUEST_METHOD']){
            case 'GET':
                $this->index();
                break;
            case 'POST':
                $this->handlePost();
                break;
            default:
                include (PROJECT_ROOT . 'Errors/405.php');
        }
    }
}