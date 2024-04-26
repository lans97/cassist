<?php
if (isset($_SESSION['user-id'])){
    unset($_SESSION['user-id']);
}
header("Location: /");
exit();