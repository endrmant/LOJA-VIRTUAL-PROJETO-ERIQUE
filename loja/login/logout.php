<?php include '../principal/connect.php'; 
  session_start();
  session_destroy();
    echo '<script>alert("você escolheu sair");</script>';
    header("Location: ../principal/index.php");
   

?>