<?php
include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$name = ucfirst($_POST['name']);
	$description =  ucfirst($_POST['description']);

	try {
		$query =
		'INSERT INTO medicines (
			name,
			description
		)
		VALUES(
			:name,
			:description
		)';

		$request = $connection->prepare($query);
		$request->bindParam(':name', $name);
		$request->bindParam(':description', $description);

		$request->execute();

		$_SESSION['msg'] = 'Registro agregado correctamente';
		$_SESSION['type'] = 'success';

		header("Location: $urlMedicine");
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo agregar el registro, contacta para más información';
		$_SESSION['type'] = 'danger';

		header("Location: $urlMedicine");
	}
}