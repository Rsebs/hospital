<?php
include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$name =  ucfirst($_POST['name']);
	$cod = ucfirst($_POST['cod']);
	$id = $_POST['id'];

	try {
		$query =
		'UPDATE 
			genders 
		SET
			name = :name,
			cod = :cod
		WHERE 
			id = :id';

		$request = $connection->prepare($query);
		$request->bindParam(':name', $name);
		$request->bindParam(':cod', $cod);
		$request->bindParam(':id', $id);

		$request->execute();

		$_SESSION['msg'] = 'Registro editado correctamente';
		$_SESSION['type'] = 'success';

		header("Location: $urlGender");
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo editar el registro, contacta para más información';
		$_SESSION['type'] = 'danger';

		header("Location: $urlGender");
	}
}
