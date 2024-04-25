<?php namespace App\Controllers\Views\Admin;

class LoginController {
    public function index() {
        include PROJECT_ROOT . "templates/header.php";
        include PROJECT_ROOT . "Views/Admin/login.php";
        include PROJECT_ROOT . "templates/footer.php";
    }
}