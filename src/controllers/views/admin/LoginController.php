<?php namespace App\Controller;

class LoginController {
    public function index() {
        include PROJECT_ROOT . "templates/header.php";
        include PROJECT_ROOT . "views/admin/login.php";
        include PROJECT_ROOT . "templates/footer.php";
    }
}