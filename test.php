<?php

$salt = random_bytes(16);
$test = "password";
$hash = password_hash($salt . $test, PASSWORD_DEFAULT);

echo $test;
echo "\n";
echo $hash;
echo "\n";

if (password_verify($salt . $test, $hash)) {
    echo "yes\n";
} else {
    echo "no\n";
}
