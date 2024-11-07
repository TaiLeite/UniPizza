<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM pizzas");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pizzas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Menu de Pizzas</h1>
        <a href="cadastrar_pizza.php" class="btn btn-success mb-3">Cadastrar Nova Pizza</a>
        <a href="cardapio.php" class="btn btn-info mb-3">Fazer Pedido</a> <!-- Link para o cardápio -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pizza = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $pizza['nome']; ?></td>
                        <td><?php echo $pizza['descricao']; ?></td>
                        <td><?php echo number_format($pizza['preco'], 2, ',', '.'); ?></td>
                        <td>
                            <a href="editar_pizza.php?id=<?php echo $pizza['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="deletar_pizza.php?id=<?php echo $pizza['id']; ?>" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
