<?php
global $link;
$host = 'localhost';
$db   = 'sendit';
$user = 'root';
$pass = 'aiico20_A#@MGsy';
$charset = 'utf8mb4';
$collate = 'utf8mb4_unicode_ci';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_PERSISTENT => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
];
try {
     $link = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, "", $options);
} catch (PDOException $e) {
    // echo $e->getMessage();
}
