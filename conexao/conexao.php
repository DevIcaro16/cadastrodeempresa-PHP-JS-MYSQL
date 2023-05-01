<?php

//Arquivo PHP para realizar a conexao com o Banco De Dados e selecionar as informações do BD : 

$host = "localhost";
$user = "root";
$password = "";
$dbname ="cadastrodeempresa";

try {
    $connect = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

    //echo"Conexão com o banco de dados realizada com sucesso!<br>";
} catch (PDOException $erro) {
    echo"Erro : Não foi possível realizar a conexão com o banco de dados!<br>";
    echo "Erro Gerado : " . $erro->getMessage();
}



?>