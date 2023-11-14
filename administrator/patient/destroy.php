<?php
include '../../includes/urls.php';
require '../../config/db.php';

session_start();

if ($_POST) {
	$id = $_POST['id'];

	try {
		$query = 'DELETE FROM patients WHERE id = :id';

		$request = $connection->prepare($query);
		$request->bindParam(':id', $id);
		$request->execute();

		$_SESSION['msg'] = 'Registro eliminado correctamente';
		$_SESSION['type'] = 'success';

		header("Location: index.php");
		exit();
	} catch (Exception $error) {
		$_SESSION['msg'] = 'No se pudo eliminar el registro, contacta para más información ';
		$_SESSION['type'] = 'danger';
		
		header('location: index.php');
	}
}