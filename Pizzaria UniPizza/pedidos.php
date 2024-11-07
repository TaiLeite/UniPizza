<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['user_id'];
$result = $conn->query("SELECT p.id, pi.nome, pr.quantidade, pr.status, pr.data_pedido 
                        FROM pedidos pr
                        JOIN pizzas pi ON pr.pizza_id = pi.id
                        WHERE pr.usuario_id = $usuario_id");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Meus Pedidos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Quantidade</th>
                    <th>Status</th>
                    <th>Data do Pedido</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pedido = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $pedido['nome']; ?></td>
                        <td><?php echo $pedido['quantidade']; ?></td>
                        <td><?php echo $pedido['status']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
