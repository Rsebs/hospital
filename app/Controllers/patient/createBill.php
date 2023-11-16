<?php

include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$pat_id = $_POST['pat_id'];
	$per_id = $_POST['per_id'];
	$medicine_id = $_POST['medicine_id'];
	$description = $_POST['description'];
	$amount = $_POST['amount'];

	try {
		$sql = 
		'INSERT INTO bills (
			pat_id,
			per_id,
			medicine_id,
			description,
			amount
		) 
		VALUES (
			:pat_id,
			:per_id,
			:medicine_id,
			:description,
			:amount
		)';

		$request = $connection->prepare($sql);
		$request->bindParam(':pat_id', $pat_id);
		$request->bindParam(':per_id', $per_id);
		$request->bindParam(':medicine_id', $medicine_id);
		$request->bindParam(':description', $description);
		$request->bindParam(':amount', $amount);

		$request->execute();

		$_SESSION['msg'] = 'Registro agregado correctamente';
		$_SESSION['type'] = 'success';

		header("Location: $urlPatient");
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo agregar el registro, contacta para más información ';
		$_SESSION['type'] = 'danger';

		header("Location: $urlPatient");
	}
}
