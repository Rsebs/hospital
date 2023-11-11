<?php
$page = 'Agregar Medicina';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

require '../../config/db.php';

// INSERT
if ($_POST) {
	$medicine_name = ucfirst($_POST['medicine_name']);
	$medicine_description =  ucfirst($_POST['medicine_description']);

	try {
		$query =
			'INSERT INTO 
			medicines 
		VALUES(
			NULL, 
			:medicine_name,
			:medicine_description
		)';

		$request = $connection->prepare($query);
		$request->bindParam(':medicine_description', $medicine_description);
		$request->bindParam(':medicine_name', $medicine_name);

		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => {
			    showAlert('#alert', 'Registro agregado correctamente');
			    redirect('$urlServer/administrator/medicine/', 4000);
			});
		
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo realizar el registro. El medicamento \"$medicine_name\" ya existe', 'error'));
		</script>
		";
	}
}

?>
<main>
	<?php if (!$_POST) { ?>
		<form action="create.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Agrega Nueva Medicina</h1>
			<div class="mt-4">
				<div class="input-group mb-4">
					<label for="medicine_name" class="input-group-text">Nombre</label>
					<input type="text" name="medicine_name" id="medicine_name" class="form-control" placeholder="Ej: Naproxeno" required>
				</div>
				<div class="form-floating">
					<textarea class="form-control" placeholder="Leave a comment here" id="medicine_description" name="medicine_description" style="height: 200px" required></textarea>
					<label for="medicine_description">Descripción</label>
				</div>
				<div class="d-flex justify-content-center gap-4 mt-3">
					<button type="submit" class="btn btn-success w-25">Guardar</button>
					<a href="index.php" class="btn btn-danger w-25">Cancelar</a>
				</div>
		</form>
	<?php } else { ?>
		<div class="container">
			<div id="alert"></div>
			<?php if (isset($error)) { ?>
				<div class="d-flex">
					<a href="create.php" class="btn btn-success d-block w-25 mt-5 mb-0 mx-auto">Agregar Registro</a>
					<a href="index.php" class="btn btn-danger d-block w-25 mt-5 mb-0 mx-auto">Volver</a>
				</div>
			<?php } else { ?>
				<a href="index.php" class="btn btn-success d-block w-50 mt-5 mb-0 mx-auto">Volver</a>
			<?php } ?>
		</div>
	<?php } ?>
</main>

<?php include '../../includes/footer.php'; ?>