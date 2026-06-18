<?php
$host   = getenv('DB_HOST')     ?: '172.16.108.6';
$dbname = getenv('DB_NAME')     ?: 'm2_valres';
$user   = getenv('DB_USER')     ?: 'root';
$pass   = getenv('DB_PASSWORD') ?: 'Azerty31';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
