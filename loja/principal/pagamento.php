<?php
include '../principal/connect.php';
session_start();

$itens = [];
$total = 0;

if (!empty($_SESSION['carrinho'])) {
    $ids = implode(',', array_keys($_SESSION['carrinho']));

    $sql = "SELECT * FROM produtos WHERE ID IN ($ids)";
    $resultado = $conn->query($sql);

    while ($produto = $resultado->fetch_assoc()) {
        $quantidade = $_SESSION['carrinho'][$produto['ID']];
        $subtotal   = $produto['PRECO'] * $quantidade;
        $total     += $subtotal;

        $itens[] = [
            'produto'    => $produto,
            'quantidade' => $quantidade,
            'subtotal'   => $subtotal,
        ];
    }
}

$pagamentoConfirmado = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && !empty($itens)) {
    unset($_SESSION['carrinho']);
    $pagamentoConfirmado = true;
    $itens = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pagamento.css">
    <title>Pagamento</title>
</head>
<body>
    <div class="blocoform">
        <h4>Pagamento</h4>

        <?php if ($pagamentoConfirmado): ?>

            <p class="sucesso">Pagamento confirmado! Obrigado pela compra.</p>
            <a class="voltar" href="../principal/index.php">Voltar para a loja</a>

        <?php elseif (empty($itens)): ?>

            <p class="vazio-msg">Seu carrinho está vazio.</p>
            <a class="voltar" href="../principal/index.php">Voltar para a loja</a>

        <?php else: ?>

            <div class="resumo-pedido">
                <?php foreach ($itens as $item): ?>
                    <div class="linha-pedido">
                        <span><?php echo $item['produto']['NOME']; ?> x<?php echo $item['quantidade']; ?></span>
                        <span>R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="linha-total">
                    <span>Total</span>
                    <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                </div>
            </div>

            <div class="metodo">
                <h5>Cartão de crédito</h5>
                <button><img src="../images/credito.jpg" alt="card"></button>
            </div>

            <div class="metodo">
                <h5>Pix</h5>
                <button><img src="../images/pix.jpg" alt="pix"></button>
            </div>
                    
            <form action="pagamento.php" method="POST">
                <button type="submit" name="confirmar" value="1" class="confirmar">Confirmar Pagamento</button>
            </form>

        <?php endif; ?>
    </div>
</body>
</html>