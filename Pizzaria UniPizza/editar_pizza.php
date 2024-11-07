<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM pizzas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$pizza = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $ingredientes = $_POST['ingredientes'];

    $stmt = $conn->prepare("UPDATE pizzas SET nome = ?, descricao = ?, preco = ?, ingredientes = ? WHERE id = ?");
    $stmt->bind_param("ssds", $nome, $descricao, $preco, $ingredientes, $id);
    $stmt->execute();

    header("Location: menu.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pizza</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Pizza</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $pizza['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" class="form-control" required><?php echo $pizza['descricao']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" name="preco" class="form-control" value="<?php echo $pizza['preco']; ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <textarea name="ingredientes" class="form-control"><?php echo $pizza['ingredientes']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Salvar</button>
        </form>
    </div>
</body>
</html>
