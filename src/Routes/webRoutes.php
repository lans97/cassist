<?php
switch ($route) {
    case '':
        // Handle home page request
        $controller = new App\Controllers\Views\HomeController();
        $controller->index();
        break;
    case 'about':
        // Handle about page request
        echo 'About Us';
        break;
    // Add more routes as needed
    default:
        // Handle 404 error
        http_response_code(404);
        echo 'Page not found';
        break;
}