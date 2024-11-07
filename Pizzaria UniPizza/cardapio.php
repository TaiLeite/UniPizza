<?php
session_start();
include 'db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Captura a mensagem de feedback se existir na URL
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';
$mensagem_tipo = isset($_GET['mensagem_tipo']) ? $_GET['mensagem_tipo'] : '';

// Realiza a consulta para exibir todas as pizzas
$result = $conn->query("SELECT * FROM pizzas");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - Pizzaria</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <h1>Cardápio - Pizzaria Deliciosa</h1>
    </header>

    <div class="container">
        <h2>Escolha Sua Pizza</h2>

        <!-- Exibe a mensagem de feedback (se houver) -->
        <?php if ($mensagem): ?>
            <div class="alert alert-<?php echo $mensagem_tipo; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <!-- Exibe os itens do cardápio em forma de cartões -->
        <div class="cardapio-container">
            <?php while ($pizza = $result->fetch_assoc()): ?>
                <div class="cardapio-item">
                    <!-- Imagem da pizza -->
                    <img src="img/<?php echo $pizza['id']; ?>.jpg" alt="Pizza <?php echo $pizza['nome']; ?>">

                    <!-- Nome e descrição -->
                    <h3><?php echo $pizza['nome']; ?></h3>
                    <p><?php echo $pizza['descricao']; ?></p>
                    
                    <!-- Preço -->
                    <div class="preco">R$ <?php echo number_format($pizza['preco'], 2, ',', '.'); ?></div>

                    <!-- Formulário para adicionar pizza ao pedido -->
                    <form method="POST" action="adicionar_pedido.php">
                        <input type="number" name="quantidade" value="1" min="1" required>
                        <input type="hidden" name="pizza_id" value="<?php echo $pizza['id']; ?>">
                        <button type="submit">Adicionar ao Pedido</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

    <!-- Rodapé -->
    <footer>
        <h1>Pizzaria Deliciosa - Todos os direitos reservados</h1>
    </footer>
</body>
</html>
