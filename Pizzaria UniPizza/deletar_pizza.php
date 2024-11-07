<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM pizzas WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: menu.php");
?>
