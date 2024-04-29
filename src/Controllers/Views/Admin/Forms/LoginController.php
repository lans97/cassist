<?php
namespace App\Controllers\Views\Admin\Forms;

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

        try {
            $handler->login($_POST["username"], $_POST["password"]);

            $user = $handler->get_user($loginData);
            $_SESSION["token"] = md5(uniqid(microtime(), true));
            $_SESSION["username"] = $user['username'];
            header('Location: /admin/cruds');
            exit();
        } catch (\Exception $e) {
            echo "<script>
                    alert('Incorrect username or password');
                  </script>";
        } catch (\PDOException $e) {
            $msg = $e->getMessage();
            echo "<script>
                    alert('$msg');
                  </script>";
        }
    }

    public function handleCalls() {
        if (isset($_SESSION['token'])) {
            header("Location: /admin/cruds");
            exit();
        }
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
