<?php
$host = 'localhost';
$db   = 'robot_arm';
$user = 'root';        // change if you set another user
$pass = '';            // change if you set a password

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
header('Access-Control-Allow-Origin: *');   // ESP32 & web page both hit these files
header('Content-Type: application/json');
