<?php
include '../principal/connect.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="blocoform">
        <form action="" method="POST" autocomplete="off">
            <img src="../images/ChatGPT Image 25 de abr. de 2026, 16_43_03.png" alt="logo">
            <input type="text" name="user" placeholder="Seu usuario"required>
            <input type="text" name="senha" id="senha" placeholder="Sua senha" required>
            <button type="submit">Login</button>
            <h5>Não tem cadastro?<a href="cadastro.php">clique aqui!</a></h5>
            <div class="getout">
                <a href="../principal/index.php">Deixar para depois</a>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['user'];
            $senha = md5($_POST['senha']);

            $sql = "SELECT * FROM usuarios WHERE USUARIO = '$user' AND SENHA = '$senha'";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows == 1) {
                echo '<script>alert("Bem-vindo!"); window.location.href="../principal/index.php";</script>';
                $_SESSION['username'] = $user;
                $_SESSION['user_id'] = $resultado->fetch_assoc()['ID']; // Armazena o ID do usuário na sessão 
            } else {
                echo '<script>alert("Dados não encontrados, tente novamente."); preventDefault(); window.location.reload(); </script>';
            }
        }

        ?>
    </div>
</body>
</html>