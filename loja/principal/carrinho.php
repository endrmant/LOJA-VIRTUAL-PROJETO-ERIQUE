<?php
include '../principal/connect.php';
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = []; 
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produtoId = (int) ($_POST['produto_id'] ?? 0);
    $acao      = $_POST['acao'] ?? '';
    $origem    = $_POST['origem'] ?? 'carrinho';

    if ($produtoId > 0) {
        switch ($acao) {
            case 'adicionar':
            case 'comprar':
                $_SESSION['carrinho'][$produtoId] = ($_SESSION['carrinho'][$produtoId] ?? 0) + 1;
                break;

            case 'diminuir':
                if (!empty($_SESSION['carrinho'][$produtoId])) {
                    $_SESSION['carrinho'][$produtoId]--;
                    if ($_SESSION['carrinho'][$produtoId] <= 0) {
                        unset($_SESSION['carrinho'][$produtoId]);
                    }
                }
                break;

            case 'remover':
                unset($_SESSION['carrinho'][$produtoId]);
                break;
        }
    }

    
    if ($origem === 'index' && $acao === 'adicionar') {
        header("Location: ../principal/index.php");
    } else {
        header("Location: carrinho.php");
    }
    exit();
}


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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="carrinho.css">
    <title>Carrinho</title>
</head>
<body>

    <header>
        <a class="voltar-loja" href="../principal/index.php">&larr; Voltar para a loja</a>
        <h1 class="titulo">Meu Carrinho</h1>
    </header>

    <div class="carrinho-container">
        <?php if (empty($itens)): ?>
            <div class="vazio">
                <p>Seu carrinho está vazio.</p>
                <a class="botao-link" href="../principal/index.php">Ver produtos</a>
            </div>
        <?php else: ?>

            <div class="lista-itens">
                <?php foreach ($itens as $item): ?>
                    <div class="item-carrinho">
                        <img src="../images/produto-placeholder.png" alt="<?php echo $item['produto']['NOME']; ?>">

                        <div class="item-info">
                            <h3><?php echo $item['produto']['NOME']; ?></h3>
                            <p class="preco-unitario">R$ <?php echo number_format($item['produto']['PRECO'], 2, ',', '.'); ?> cada</p>
                        </div>

                        <form action="carrinho.php" method="POST" class="item-quantidade">
                            <input type="hidden" name="produto_id" value="<?php echo $item['produto']['ID']; ?>">
                            <button type="submit" name="acao" value="diminuir" aria-label="Diminuir quantidade">-</button>
                            <span><?php echo $item['quantidade']; ?></span>
                            <button type="submit" name="acao" value="adicionar" aria-label="Aumentar quantidade">+</button>
                        </form>

                        <p class="subtotal">R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></p>

                        <form action="carrinho.php" method="POST">
                            <input type="hidden" name="produto_id" value="<?php echo $item['produto']['ID']; ?>">
                            <button type="submit" name="acao" value="remover" class="remover">Remover</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="resumo">
                <p class="total">Total <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span></p>
                <a class="finalizar" href="pagamento.php">Finalizar Compra</a>
            </div>

        <?php endif; ?>
    </div>
</body>
</html>