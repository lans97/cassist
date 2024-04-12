<?php
echo "Reached HomeController.php";

class HomeController {
    public function index() {
        include '../templates/header.php';
        include '../views/home.php';
        include '../templates/footer.php';
    }
}

?>