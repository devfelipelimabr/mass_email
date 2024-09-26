<?php
// db.php
$host = "localhost";
$user = "root";
$pass = "128145";
$db = "mass_email_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
