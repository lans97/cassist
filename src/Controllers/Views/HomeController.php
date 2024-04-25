<?php namespace App\Controllers\Views;

class HomeController {
    public function index() {
        include '../templates/header.php';
        include '../views/home.php';
        include '../templates/footer.php';
    }
}

$homeController = new HomeController();
$homeController->index();