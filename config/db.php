<?php
$server = 'localhost';
$db = 'hospital';
$user = 'root';
$password = '';

try {
	$connection = new PDO("mysql:host=$server;dbname=$db", $user, $password);
	// echo 'Conexión establecida';
} catch (Exception $e) {
	echo 'Excepcion capturada: ', $e->getMessage();
}