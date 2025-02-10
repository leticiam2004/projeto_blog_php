<?php

$servername = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "database";

$conn = new mysqli(hostname: $servername, username: $user, password: $password, database: $dbname);

if ($conn->connect_error) {
    die("Problemas com a conexão: " . $conn->connect_error);
}
?>