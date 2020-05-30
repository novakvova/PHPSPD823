<?php
include_once("config.php");
try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASSWORD);
    $dbh->exec("set names ".DB_CHARSET);
    echo 'Подключение успішне ';
    exit;
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
    exit;
}