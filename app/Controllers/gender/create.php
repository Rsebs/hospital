<?php
include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$cod =  ucfirst($_POST['cod']);
	$name = ucfirst($_POST['name']);

	try {
		$query =
		'INSERT INTO genders (
			name,
			cod
		)
		VALUES(
			:name,
			:cod
		)';

		$request = $connection->prepare($query);
		$request->bindParam(':name', $name);
		$request->bindParam(':cod', $cod);

		$request->execute();

		$_SESSION['msg'] = 'Registro agregado correctamente';
		$_SESSION['type'] = 'success';

		header("Location: $urlGender");
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo agregar el registro, contacta para más información';
		$_SESSION['type'] = 'danger';

		header("Location: $urlGender");
	}
}