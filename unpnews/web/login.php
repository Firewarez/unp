<?php

session_start();

include "./credentials.php";


$login = $_POST['nome'];
$senha = $_POST['senha'];

 $path = "Location: ../index.php";

    $mysqli = mysqli_connect($db_ip,$db_user,$db_password,$database);
    $query = "SELECT * FROM users WHERE nome = '$login' AND senha = '$senha'";
    $result = mysqli_query($mysqli, $query);
    if($result){
        $_SESSION['nome'] = $login;
        $_SESSION['senha'] = $senha;
        unset($_SESSION['msgerro']);
        unset($_SESSION['erro']);
        header($path);
    }else{
        unset ($_SESSION['nome']);
        unset ($_SESSION['senha']);
        $_SESSION['msgerro'] = "Usuário ou senha inválidos";
    }

?>