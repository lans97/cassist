<?php namespace App\Controllers\Views\Admin\Forms;

class CategoriesController {
    public function index() {
        include PROJECT_ROOT . "views/admin/forms/categories.php";
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