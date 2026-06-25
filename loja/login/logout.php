<?php include '../principal/connect.php'; 
  session_start();
  session_destroy();
    header("Location: ../principal/index.php");
    echo '<script>alert("você escolheu sair");</script>';

?>