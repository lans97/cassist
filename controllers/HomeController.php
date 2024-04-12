<?php
echo "Reached HomeController.php";

class HomeController {
    public function index() {
        echo "Reached HomeController index() method.";
        include '../templates/header.php';
        include '../views/home.php';
        include '../templates/footer.php';
    }
}

$homeController = new HomeController();
$homeController->index();
?>