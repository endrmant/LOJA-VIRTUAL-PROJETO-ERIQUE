

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>login</title>
</head>
<body>
    <div class="bloco">
        
        <form method="POST" action="#" autocomplete= "off">
            <h3>Bem vindo de volta!</h3>
            <img class="logo" src="images/ChatGPT Image 25 de abr. de 2026, 16_43_03.png" alt="logo anim">
            <input type="text" name="displayname" placeholder="nome de usuario" required>
            <input type="password" name="senha" placeholder="senha" required>
            <button type="submit">ENTRAR</button>
            <p>não tem cadastro? <a href="cadastro.php">clique aqui</a></p>
        </form>
        
    </div>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
    $nomeusuario = $_POST['displayname'];
    $senhausuario = md5($_POST['senha']);

    $sql = "SELECT * FROM login WHERE nome = '$nomeusuario' AND senha = '$senhausuario'";

    $resultado = $conexao -> query($sql);

    if ($resultado -> num_rows == 1) {
        echo'<script>alert("bem vindo"); window.location.href="index.html";</script>';
        $_SESSION['username'] = $nomeusuario;
    } else {
        echo '<script>alert("dados não encontrados, tente novamente");e.preventDefault();window.location.reload();</script>';
    }
     
    }
    ?>
</body>
</html>