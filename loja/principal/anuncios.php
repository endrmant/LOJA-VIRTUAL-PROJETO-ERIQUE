<?php 
include 'connect.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Meus Anúncios</title>
    <style>
        body {
            background-color: #1A1A1B;
            color: #ffffff;
        }

        .blocoform {
            max-width: 1040px;
            margin: 40px auto 60px;
            padding: 30px;
            background: #2A2A2C;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.45);
        }

        .blocoform h2 {
            color: #FFD700;
            margin-bottom: 20px;
        }

         table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

         th,
         td {
            padding: 16px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            vertical-align: top;
            color: #E5E5E5;
        }

         th {
            background: rgba(255, 215, 0, 0.09);
            color: #FFD700;
            text-align: left;
            font-weight: 700;
        }

        .sem-anuncios {
            margin-top: 24px;
            color: #cfcfcf;
        }

        .getout {
            margin-top: 28px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .getout a {
            padding: 12px 18px;
            background: #FFD700;
            color: #1A1A1B;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            transition: background-color 0.25s ease;
        }

        .getout a:hover {
            background: #ffe95c;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin: 20px auto;
        }

        form button {
            padding: 8px 14px;
            background: #FF4B4B;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }
    </style>
</head>
<body>
    <header>
        <img class="logo" src="../images/ChatGPT Image 25 de abr. de 2026, 16_43_03.png" alt="COMPREI!">
    </header>

    <div class="blocoform">
        <h2>Meus Anuncios</h2>
        <?php
        if (isset($_SESSION['user_id'])) {
            $cliente_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM produtos WHERE CLIENTE_ID = '$cliente_id'";
            $resultado = $conn->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                echo '<table>';
                echo '<thead><tr><th>Nome</th><th>Descrição</th><th>Preço</th><th>Tipo</th></tr></thead>';
                echo '<tbody>';
                while ($produto = $resultado->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . ($produto['NOME']) . '</td>';
                    echo '<td>' . ($produto['DESCRICAO']) . '</td>';
                    echo '<td>R$' . number_format($produto['PRECO'], 2, ',', '.') . '</td>';
                    echo '<td>' . ($produto['TIPO']) . '</td>';
                    echo '<td>';
                    echo '<form method="POST" action="" onsubmit="confirm(\'Tem certeza que deseja excluir este anúncio: ' . $produto['NOME'] . '?\');">';
                    echo '<input type="hidden" name="produto_id" value="' . $produto['ID'] . '">';
                    echo '<button type="submit">Excluir</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p class="sem-anuncios">Você não possui anúncios.</p>';
            }
        }
        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
            $produto_id = $_POST['produto_id'];
            $sql = "DELETE FROM produtos WHERE ID = '$produto_id' AND CLIENTE_ID = '$cliente_id'";
            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Anuncio excluído com sucesso!"); window.location.href="anuncios.php";</script>';
            } else {
                echo '<script>alert("Erro ao excluir anuncio");</script>';
            }
        }

        ?>

        <div class="getout">
            <a href="index.php">Voltar à Loja</a>
            <a href="anunciar.php">Criar Novo Anúncio</a>
        </div>
    </div>
</body>
</html>

