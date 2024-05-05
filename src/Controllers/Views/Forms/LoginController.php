<?php
namespace App\Controllers\Views\Forms;

class LoginController {
    private function index() {
        $title = "Login";
        $content = file_get_contents(PROJECT_ROOT . "views/forms/login.php");
        include (PROJECT_ROOT . "templates/admin/base.php");
    }
        
    public function handlePost() {
        require_once PROJECT_ROOT . "src/Utils/database.service.php";
        $pdo = getPDOConnection();
        $handler = new \App\API\Handlers\UsersHandler($pdo);

        try {
            $loginData = $handler->login($_POST["username"], $_POST["password"]);

            $user = $handler->get_user($loginData);
            $_SESSION["token"] = md5(uniqid(microtime(), true));
            $_SESSION["username"] = $user['username'];
            $_SESSION["user-id"] = $user['id'];
            header('Location: /home');
            exit();
        } catch (\Exception $e) {
            echo "<script>
                    alert('Incorrect username or password');
                    location.replace(location.href);
                  </script>";
            exit();
        } catch (\PDOException $e) {
            $msg = $e->getMessage();
            echo "<script>
                    alert('$msg');
                    location.replace(location.href);
                  </script>";
            exit();
        }
    }

    public function handleCalls() {
        switch ($_SERVER['REQUEST_METHOD']) {
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
