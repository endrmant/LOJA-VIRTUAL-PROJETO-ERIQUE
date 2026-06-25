<?php 
include '../principal/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="box">
      <img src="../images/ChatGPT Image 25 de abr. de 2026, 16_43_03.png" alt="logo">  
        <form action="" method="POST" autocomplete="off">
            <div class="campo">
                <input type="text" name="nomeusuario" required placeholder="Nome de Usuario">
            </div>
            <div class="campo">
                <input type="email" name="email" required placeholder="E-mail">
            </div>
            <div class="campo">
                <input type="date" name="datanascimento" required placeholder="Data de Nascimento">
            </div>
            <div class="campo">
                <input type="password" name="senha" required placeholder="Senha">
            </div>
            <div class="campo">
                <input type="password" name="confirmarsenha" required placeholder="Confirmar Senha">
            </div>      
            <button type="submit">Cadastrar</button>
            <h5>Ja tem conta? <a href="./login.php">clique aqui!</a></h5>
        </form>
        <div class="getout">
                <a href="../principal/index.php">Deixar para depois</a>
            </div>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nomeusuario = $_POST['nomeusuario'];
                $email = $_POST['email'];
                $datanascimento = $_POST['datanascimento'];
                $senha = md5($_POST['senha']);
                $confirmarsenha = md5($_POST['confirmarsenha']);

                if ($senha !== $confirmarsenha) {
                    echo '<script>alert("As senhas não coincidem."); window.location.reload();</script>';
                    exit();
                }

                $sql = "INSERT INTO usuarios (EMAIL, DATANASCI, SENHA, USUARIO) VALUES ('$email', '$datanascimento', '$senha', '$nomeusuario')";

                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Cadastro realizado com sucesso!"); window.location.href="login.php";</script>';
                } else {
                    echo '<script>alert("Erro ao cadastrar: ' . $conn->error . '"); window.location.reload();</script>';
                }
            }
            ?>
    </div>
</body>
</html>