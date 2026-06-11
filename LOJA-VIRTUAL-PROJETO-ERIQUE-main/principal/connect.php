<?php

$servidor = "localhost";
$user = "root";
$senha = "";
$banco = "clientes";

$conn = new mysqli($servidor, $user, $senha, $banco);

if(!$conn -> connect_error) {
    echo'conexao sucedida';
} else {
    die("erro na conexao");
}