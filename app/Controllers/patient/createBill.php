<?php

include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$id = $_POST['id'];
	$doc_id = $_POST['doc_id'];
	$medicine_id = $_POST['medicine_id'];
	$description = $_POST['description'];
	$amount = $_POST['amount'];

	try {
		$query = 'INSERT INTO bills VALUES (NULL, :id, :doc_id, :medicine_id, :description, :amount)';

		$request = $connection->prepare($query);
		$request->bindParam(':id', $id);
		$request->bindParam(':doc_id', $doc_id);
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
