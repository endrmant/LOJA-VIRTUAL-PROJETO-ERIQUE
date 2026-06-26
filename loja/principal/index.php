<?php
include 'connect.php';
session_start();

$logado = isset($_SESSION['username']);

$totalCarrinho = 0;
if (!empty($_SESSION['carrinho'])) {
    $totalCarrinho = array_sum($_SESSION['carrinho']);
}

$sql = "SELECT produtos.*, usuarios.USUARIO AS nome_cliente 
        FROM produtos 
        INNER JOIN usuarios ON produtos.CLIENTE_ID = usuarios.ID 
        ORDER BY produtos.ID DESC";

$resultadoProdutos = $conn->query($sql);
$produtos = $resultadoProdutos->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Elms+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="../scripts/script.js"></script>
    <title>COMPREI!</title>
</head>
<body>
<header>
    <img class="logo" src="../images/ChatGPT Image 25 de abr. de 2026, 16_43_03.png" alt='logo'>
    <form action="" method="GET" class="pesquisa-form" autocomplete="off">
        <input type="text" name="pesquisa" id="pesquisa" placeholder="Pesquise Produtos">
        <button type="submit">Pesquisar</button>
    </form>
    <?php
     $pesquisa = isset($_GET['pesquisa']);
     if(!empty($pesquisa)) {
        $pesquisa = $_GET['pesquisa'];
        $sql = "SELECT produtos.*, usuarios.USUARIO AS nome_cliente 
                FROM produtos 
                INNER JOIN usuarios ON produtos.CLIENTE_ID = usuarios.ID 
                WHERE produtos.NOME LIKE '%$pesquisa%' OR produtos.DESCRICAO LIKE '%$pesquisa%'
                ORDER BY produtos.ID DESC";

        $resultadoProdutos = $conn->query($sql);
        $produtos = $resultadoProdutos->fetch_all(MYSQLI_ASSOC);

    }   
    ?>
<div class="navi">
<nav>
    <ul>
        <a href="index.php">Inicio</a>

        <?php if ($logado) {
            echo "<a href='anunciar.php'>Anunciar</a>";
            echo "<a href='../login/logout.php'>Sair</a>";
        } else {
            echo "<a href='../login/login.php'>Login</a>";
        }
        ?>

        <a href="SAC">Ajuda</a>
        <a href="ofertas.html">Ofertas</a>

        <a href="carrinho.php">
            Carrinho
            <?php if ($totalCarrinho > 0): ?>(<?php echo $totalCarrinho; ?>)<?php endif; ?>
        </a>
    </ul>
</nav>
</div>
</header>

<section class="carrossel">
<div class="slides">
    <img src="https://images.openai.com/static-rsc-4/2yGALCzxobvSSFoOkCoUs6KOT3hJgCUDXPdoOXvSwRr5GqaZaMcZtt9Fu2dbB0tm4JL6nnDhDWnpuA3F0K3UNTaH8KpsYEDx1CbvBldfA_cnE6eAlaKxcDJl08LMwEVpFYnyCwySDlIgpZq2lJxqdbkT7F7t5IcBmUF6v9fyswDUjIeNncpWM4pXzG4tQlNj?purpose=fullsize" class="slide active">
    <img src="https://images.openai.com/static-rsc-4/3UfV-ORgJ2YUhmjtc6MMBJK22LonB-815mHgf3W9Dng6ch9yRWgXr0Ulw9LvvySmlw0Sv0u4QlBSQZ_JNXTvMzNIv2NuWllTon-Sgp3zu_NqMi_EdFAbf3KnuiXQKgEIXGUvPQDEV5_tOSeICcA7OseP0QuiHlAWgFEIw6-02KxZnh-25pP8shrpxx2-RJKz?purpose=fullsize" class="slide">
    <img src="../images/ChatGPT Image 28 de mai. de 2026, 18_36_27.png" class="slide">
</div>

<button class="prev" onclick="voltarSlide()">
    <
</button>
<button class="next" id="proximo" onclick="proximoSlide()">
    >
</button>

</section>


<h1 class="titulo">Produtos</h1>
<section class="produtos">

    <?php if (empty($produtos)) {
        echo "<p class='sem-produtos'>Nenhum produto disponível no momento.</p>";
    }
    ?>

    <?php foreach ($produtos as $produto): ?>
        <div class="card">
            <img src="../images/produto-placeholder.png" alt="<?php echo $produto['NOME']; ?>">
            <div class="card-conteudo">
                <h2><?php echo $produto['NOME']; ?></h2>
                <p class="descricao"><?php echo $produto['DESCRICAO']; ?></p>
                <p class="preco">R$ <?php echo number_format($produto['PRECO'], 2, ',', '.'); ?></p>
                <p class="autor" style="font-style: italic; font-weight: bold;">Vendido por: <?php echo $produto['nome_cliente']; ?></p>

                <form action="carrinho.php" method="POST" class="botoes">
                    <input type="hidden" name="produto_id" value="<?php echo $produto['ID']; ?>">
                    <input type="hidden" name="origem" value="index">
                    <button type="submit" name="acao" value="comprar" class="comprar">Comprar</button>
                    <button type="submit" name="acao" value="adicionar" class="carrinho">Adicionar</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

</section>
</body>
</html>