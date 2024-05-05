<?php namespace App\Controllers\Views\Main;

class HistoryController {
    private function index() {
        $title = "Movement History";
        ob_start();
        include (PROJECT_ROOT . "views/main/history.php");
        $content = ob_get_clean();
        include (PROJECT_ROOT . "templates/base.php");
    }

    public function handleCalls() {
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