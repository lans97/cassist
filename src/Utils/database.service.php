<?php

require_once PROJECT_ROOT . 'config/database.php';

function getPDOConnection() {
  $config = require_once PROJECT_ROOT . 'config/database.php';
  $dbConfig = $config['default'];

  $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}";
  $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $pdo;
}