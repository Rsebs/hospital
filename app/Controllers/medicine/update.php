<?php
include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$name =  ucfirst($_POST['name']);
	$description = ucfirst($_POST['description']);
	$id = $_POST['id'];

	try {
		$query =
		'UPDATE 
			medicines 
		SET
			name = :name,
			description = :description
		WHERE 
			id = :id';

		$request = $connection->prepare($query);
		$request->bindParam(':name', $name);
		$request->bindParam(':description', $description);
		$request->bindParam(':id', $id);

		$request->execute();

		$_SESSION['msg'] = 'Registro editado correctamente';
		$_SESSION['type'] = 'success';

		header("Location: $urlMedicine");
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo editar el registro, contacta para más información';
		$_SESSION['type'] = 'danger';

		header("Location: $urlMedicine");
	}
}