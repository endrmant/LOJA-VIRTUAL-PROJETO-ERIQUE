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
</head>
<body>

    <form action="" method="POST" autocomplete="off">
        <h4>O que vamos anunciar?</h4>
        <input type="text" name="nomeproduto" required placeholder="Nome do Produto" maxlength="150">
        <input type="text" name="tipo" required placeholder="Tipo / Categoria (ex: Eletrônico, Roupa)" maxlength="30">
        <input type="number" name="preco" required placeholder="Preço (R$)" step="0.01" min="0">
        <input type="text" name="descricao" required placeholder="Descrição do Produto">
        <button type="submit">Anunciar</button>
    </form>

    <br>
    <button onclick="window.location.href='../principal/index.php'">Voltar</button>

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
                    alert("Anúncio criado com sucesso!");
                    window.location.href="../principal/index.php";
                  </script>';
            exit();
        } else {
            echo '<script>
                    alert("Erro ao criar anúncio: ' . addslashes($conn->error) . '");
                  </script>';
        }
    }
    ?>
</body>
</html>