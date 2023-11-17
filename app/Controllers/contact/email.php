<?php
include '../../../includes/urls.php';
session_start();

if ($_POST) {
	$_SESSION['msg'] = '¡Gracias por comunicarse con nosotros, espera nuestra respuesta!';
	$_SESSION['type'] = 'success';

	header("Location: $urlContact");
}
