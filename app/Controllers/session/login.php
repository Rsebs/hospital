<?php
include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$user_name = $_POST['user_name'];
	$user_pass = $_POST['user_pass'];

	try {
		$query = 'SELECT * FROM users WHERE user_name = :user_name';

		$request = $connection->prepare($query);
		$request->bindParam(':user_name', $user_name);
		$request->execute();

		$resultUser = $request->fetch(PDO::FETCH_LAZY);

		if ($resultUser) {
			if (password_verify($user_pass, $resultUser['user_pass'])) {
				$_SESSION['id'] = $resultUser['id'];
				$_SESSION['user_name'] = $resultUser['user_name'];

				$query =
				'UPDATE 
					users 
				SET
					last_login = :last_login
				WHERE 
					id = :id';

				$request = $connection->prepare($query);
				$request->bindParam(':last_login', date('Y-m-d H:i:s'));
				$request->bindParam(':id', $_SESSION['id']);

				$request->execute();
				header("location: $urlIndex");
			} else {
				$_SESSION['msg'] = 'Contraseña incorrecta';
				$_SESSION['type'] = 'danger';
				header("Location: $urlLogin");
			}
		} else {
			$_SESSION['msg'] = 'El usuario no existe';
			$_SESSION['type'] = 'danger';
			header("Location: $urlLogin");
		}
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo iniciar sesión, contacta para más información';
		$_SESSION['type'] = 'danger';

		header("Location: $urlLogin");
	}
}
?>