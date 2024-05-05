<?php

if (isset($_SESSION['token'])){
    unset($_SESSION['token']);
    unset($_SESSION['user-id']);
    unset($_SESSION['username']);
    if(isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
    }
}
header("Location: /");
exit();