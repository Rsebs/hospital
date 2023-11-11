<?php
$page = 'Editar Género';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

require '../../config/db.php';

// INSERT
if ($_POST) {
	$gender_cod =  ucfirst($_POST['gender_cod']);
	$gender_name = ucfirst($_POST['gender_name']);

	try {
		$query =
			'INSERT INTO 
			genders 
		VALUES(
			NULL, 
			:gender_cod,
			:gender_name
		)';

		$request = $connection->prepare($query);
		$request->bindParam(':gender_cod', $gender_cod);
		$request->bindParam(':gender_name', $gender_name);

		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => {
			    showAlert('#alert', 'Registro agregado correctamente');
			    redirect('$urlServer/administrator/gender/', 4000);
			});
		
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo realizar el registro. El género \"$gender_name\" o \"$gender_cod\" ya existe', 'error'));
		</script>
		";
	}
}

?>
<main>
	<?php if (!$_POST) { ?>
		<form action="create.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Agrega Nuevo Género</h1>
			<div class="mt-4 row">
				<div class="col-md input-group mb-4">
					<label for="gender_name" class="input-group-text">Nombre</label>
					<input type="text" name="gender_name" id="gender_name" class="form-control" placeholder="Ej: Masculino" required>
				</div>
				<div class="col-md input-group mb-4">
					<label for="gender_cod" class="input-group-text">Código</label>
					<input type="text" name="gender_cod" id="gender_cod" class="form-control" placeholder="Ej: M" required>
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