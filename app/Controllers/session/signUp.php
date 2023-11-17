<?php 
include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$user_name = $_POST['user_name'];
	$user_pass = $_POST['user_pass'];

	// Hash a la contraseña
	$user_hash_pass = password_hash($user_pass, PASSWORD_BCRYPT);

	try {
		$query = 'INSERT INTO users(user_name, user_pass) VALUES(:user_name, :user_hash_pass)';

		$request = $connection->prepare($query);
		$request->bindParam(':user_name', $user_name);
		$request->bindParam(':user_hash_pass', $user_hash_pass);
		$request->execute();

		$_SESSION['msg'] = "Te has registrado correctamente";
		$_SESSION['type'] = 'success';
		header("Location: $urlLogin");
	} catch (Exception $error) {
		$_SESSION['msg'] = "El usuario \"$user_name\" ya existe";
		$_SESSION['type'] = 'danger';
		header("Location: $urlSignUp");
	}
}