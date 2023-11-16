<?php

include '../../../includes/urls.php';
require '../../../config/db.php';

session_start();

if ($_POST) {
	$document =  $_POST['document'];
	$first_name = ucfirst($_POST['first_name']);
	$second_name = ucfirst($_POST['second_name']);
	$first_last_name = ucfirst($_POST['first_last_name']);
	$second_last_name = ucfirst($_POST['second_last_name']);
	$gender_id = $_POST['gender_id'];
	$email = strtolower($_POST['email']);
	$contact_number = $_POST['contact_number'];

	try {
		$query =
		'INSERT INTO personals (
			document, 
			first_name, 
			second_name,
			first_last_name,
			second_last_name, 
			gender_id, 
			email,
			contact_number
		)
		VALUES( 
			:document, 
			:first_name, 
			:second_name,
			:first_last_name,
			:second_last_name, 
			:gender_id, 
			:email,
			:contact_number
		)';

		$request = $connection->prepare($query);
		$request->bindParam(':document', $document);
		$request->bindParam(':first_name', $first_name);
		$request->bindParam(':second_name', $second_name);
		$request->bindParam(':first_last_name', $first_last_name);
		$request->bindParam(':second_last_name', $second_last_name);
		$request->bindParam(':gender_id', $gender_id);
		$request->bindParam(':email', $email);
		$request->bindParam(':contact_number', $contact_number);

		$request->execute();

		$_SESSION['msg'] = 'Registro agregado correctamente';
		$_SESSION['type'] = 'success';

		header("Location: $urlPersonal");
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo agregar el registro, contacta para más información';
		$_SESSION['type'] = 'danger';

		header("Location: $urlPersonal");
	}
}