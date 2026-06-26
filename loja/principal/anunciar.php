<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Anúncio</title>
    <link rel="stylesheet" href="anunciar.css">
</head>
<body>
<div class="blocoform">
    <form action="" method="POST" autocomplete="off">
        <h4>O que vamos anunciar?</h4>
        <input type="text" name="nomeproduto" required placeholder="Nome do Produto" maxlength="150">
        <select name="tipo" required>
            <option value="">Tipo</option>
            <option value="eletronicos">Eletrônicos</option>
            <option value="roupas">Roupas</option>
            <option value="livros">Livros</option>
            <option value="moveis">Móveis</option>
            <option value="outros">Outros</option>
        </select>
        <input type="number" name="preco" required placeholder="Preço (R$)" step="0.01" min="0">
        <input type="text" name="descricao" required placeholder="Descrição do Produto">
        <button type="submit">Anunciar</button>
    </form>
</div>
    <br>
    <div class="getout">
    <button onclick="window.location.href='../principal/index.php'">Voltar</button>
    <button onclick="window.location.href='anuncios.php'">Meus Anuncios</button>
    </div>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomeproduto = $_POST['nomeproduto'];
        $tipo        = $_POST['tipo'];
        $preco       = $_POST['preco'];
        $descricao   = $_POST['descricao'];
        $cliente_id  = $_SESSION['user_id'];

        $sql = "INSERT INTO produtos (NOME, TIPO, PRECO, DESCRICAO, CLIENTE_ID) VALUES ('$nomeproduto', '$tipo', '$preco', '$descricao', '$cliente_id')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>
                    alert("Anuncio criado com sucesso!");
                    window.location.href="../principal/index.php";
                  </script>';
        } else {
            echo '<script>
                    alert("Erro ao criar anuncio");
                  </script>';
        }
    }
    ?>
</body>
</html>