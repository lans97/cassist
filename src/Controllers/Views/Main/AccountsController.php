<?php namespace App\Controllers\Views\Main;

class AccountsController {
    private function index() {
        $title = "My Accounts";
        ob_start();
        include (PROJECT_ROOT . "views/main/accounts.php");
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