<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $ingredientes = $_POST['ingredientes'];

    $stmt = $conn->prepare("INSERT INTO pizzas (nome, descricao, preco, ingredientes) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nome, $descricao, $preco, $ingredientes);
    $stmt->execute();

    header("Location: menu.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pizza</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Cadastrar Pizza</h1>
        <form method="POST" action="cadastrar_pizza.php">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" name="preco" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <textarea name="ingredientes" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>
</body>
</html>
