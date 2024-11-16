<?php



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usuariosdb";

    $conexao = new mysqli($servername, $username, $password, $dbname);

    if (!$conexao) {
        die("Conexão falhou: " . mysqli_connect_error());
    }else{
        echo "<script> console.log('Conexão realizada com sucesso.');</script>";
    }


?>