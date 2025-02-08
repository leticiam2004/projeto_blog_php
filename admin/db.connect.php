<?php
//db.connect.php

$servername = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "database";

// Estabelecer conexão com a base de dados

$conn = new mysqli(hostname: $servername, username: $user, password: $password, database: $dbname);

if ($conn->connect_error) {
    die("Problemas com a conexão: " . $conn->connect_error);
}
?>