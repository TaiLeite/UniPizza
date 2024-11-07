<?php
session_start();
include 'db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Variáveis de feedback
$mensagem = '';
$mensagem_tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do pedido
    $usuario_id = $_SESSION['user_id'];
    $pizza_id = $_POST['pizza_id'];
    $quantidade = $_POST['quantidade'];

    // Verifica se a quantidade é válida
    if ($quantidade < 1) {
        $mensagem = "A quantidade deve ser ao menos 1.";
        $mensagem_tipo = 'error';
    } else {
        // Tenta inserir o pedido no banco de dados
        $stmt = $conn->prepare("INSERT INTO pedidos (usuario_id, pizza_id, quantidade) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $usuario_id, $pizza_id, $quantidade);

        if ($stmt->execute()) {
            $mensagem = "Pedido adicionado com sucesso!";
            $mensagem_tipo = 'success';
        } else {
            $mensagem = "Ocorreu um erro ao adicionar o pedido. Tente novamente.";
            $mensagem_tipo = 'error';
        }
    }

    // Redireciona com feedback
    header("Location: cardapio.php?mensagem=$mensagem&mensagem_tipo=$mensagem_tipo");
    exit();
}

?>
