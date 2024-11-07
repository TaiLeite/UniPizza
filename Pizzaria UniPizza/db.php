<?php
$host = 'localhost';  // ou '127.0.0.1'
$user = 'root';  // Seu usuário do MySQL
$password = '';  // Sua senha do MySQL
$dbname = 'pizzaria';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
