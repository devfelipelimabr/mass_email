<?php
// db.php
require 'vendor/autoload.php'; // Carregar o autoloader do Composer

use Dotenv\Dotenv;

// Carregar o .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASSWORD'];
$db = $_ENV['DB_SCHEMA'];

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
