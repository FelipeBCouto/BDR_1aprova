<?php

$host = "localhost"; // nome do servidor MySQL
$user = "id20420998_dadosdatabase"; // usuário do MySQL
$pass = "Tomate50!!!>>>)"; // senha do MySQL
$dbname = "id20420998_bancodedados"; // nome do banco de dados

// Conexão com o banco de dados MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verifica se houve erro na conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
