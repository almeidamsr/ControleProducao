<?php
$servername = "localhost";
$username = "root";
$password = "matheus";
$dbname = "banco_7per_php";

	// Criando conexão
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Testando conexão
	if ($conn->connect_error) {
		die("Falha na conexão: " . $conn->connect_error);
	} 

?>