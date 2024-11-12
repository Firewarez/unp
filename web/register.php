<?php
include "credentials.php";
session_start();
$login = $_POST['nome'];
$senha = $_POST['senha'];
    $mysqli = mysqli_connect($db_ip,$db_user,$db_password,$database);
    $query = "INSERT INTO login (usuario, senha) VALUES ('$login', '$senha')";
    $result = mysqli_query($mysqli, $cadastrar);
    if($result){
        echo "Cadastrado com sucesso!";
    }else{
        echo "Erro ao cadastrar!";
    }
    
        
?>