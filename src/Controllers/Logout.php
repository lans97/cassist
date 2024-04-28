<?php

if (isset($_SESSION['token'])){
    unset($_SESSION['token']);
    unset($_SESSION['username']);
}
header("Location: /");
exit();