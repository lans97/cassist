<?php namespace App\Controllers\Views\Admin;

class LoginController {
    private function index() {
        $title = "Login";
        $content = file_get_contents(PROJECT_ROOT . "views/admin/login.php");
        include (PROJECT_ROOT . "templates/admin/base.php");
    }
    
    public function handlePost() {
        require_once PROJECT_ROOT . "src/Utils/database.service.php";
        $pdo = getPDOConnection();
        $handler = new \App\API\Handlers\UsersHandler($pdo);

        $login = $handler->login($_POST["username"], $_POST["password"]);
        if ($login) {
            session_start();
            $_SESSION["user-id"] = $login;
            echo '<script>
                    alert("Login!");
                    window.location.href="/admin/cruds";
                  </script>';
        } else {
            echo '<script>
                    alert("No login");
                    window.location.href="/admin/login";
                  </script>';
        }
    }

    public function handleCalls() {
        if (isset($_SESSION['user-id'])){
            header("Location: /admin/cruds");
            exit();
        }
        switch ($_SERVER['REQUEST_METHOD']){
            case 'GET':
                $this->index();
                break;
            case 'POST':
                $this->handlePost();
                break;
            default:
                http_response_code(405);
                echo 'Not Allowed';
        }
    }
}
