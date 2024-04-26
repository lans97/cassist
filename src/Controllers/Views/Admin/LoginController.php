<?php namespace App\Controllers\Views\Admin;

class LoginController {
    public function index() {
        $title = "Login";
        $content = file_get_contents(PROJECT_ROOT . "views/admin/login.php");
        include (PROJECT_ROOT . "templates/base.php");
    }
    public function handleLogin() {

    }
    public function handleCalls() {
    }
}