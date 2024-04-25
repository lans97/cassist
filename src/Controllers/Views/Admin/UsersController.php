<?php namespace App\Controllers\Views\Admin;

class UsersController {
    public function index() {
        include '../templates/header.php';
        include '../views/admin/users.php';
        include '../templates/footer.php';
    }
}