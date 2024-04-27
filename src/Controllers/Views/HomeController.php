<?php namespace App\Controllers\Views;

class HomeController {
    public function index() {
        $title = "Home";
        $content = file_get_contents(PROJECT_ROOT . "views/home.php");
        include (PROJECT_ROOT . "templates/base.php");
    }
}