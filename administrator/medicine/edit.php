<?php

$page = 'Editar Medicina';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

require '../../config/db.php';

try {
	$query = 'SELECT * FROM genders';

	$request = $connection->prepare($query);
	$request->execute();

	$resultGenders = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}

// SELECT
if ($_GET) {
	$medicine_id = $_GET['medicine_id'];

	try {
		$query = 'SELECT * FROM medicines WHERE medicine_id = :medicine_id';

		$request = $connection->prepare($query);
		$request->bindParam(':medicine_id', $medicine_id);
		$request->execute();

		$resultDoc = $request->fetch(PDO::FETCH_LAZY);
		$medicine_name = $resultDoc['medicine_name'];
		$medicine_description = $resultDoc['medicine_description'];
	} catch (Exception $error) {
		echo $error;
	}
}

// UPDATE
if ($_POST) {
	$medicine_name =  ucfirst($_POST['medicine_name']);
	$medicine_description = ucfirst($_POST['medicine_description']);
	$medicine_id = $_POST['medicine_id'];

	try {
		$query =
			'UPDATE 
			medicines 
		SET
			medicine_name = :medicine_name,
			medicine_description = :medicine_description
		WHERE 
			medicine_id = :medicine_id';

		$request = $connection->prepare($query);
		$request->bindParam(':medicine_name', $medicine_name);
		$request->bindParam(':medicine_description', $medicine_description);
		$request->bindParam(':medicine_id', $medicine_id);

		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => {
			    showAlert('#alert', 'Registro editado correctamente');
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
	<?php if ($_GET) { ?>

		<form action="edit.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Edita Medicina</h1>
			<input type="hidden" name="medicine_id" id="medicine_id" value="<?php echo $medicine_id; ?>">
			<div class="mt-4">
				<div class="input-group mb-4">
					<label for="medicine_name" class="input-group-text">Nombre</label>
					<input type="text" name="medicine_name" id="medicine_name" class="form-control" placeholder="Ej: Naproxeno" value="<?php echo $medicine_name; ?>" required>
				</div>
				<div class="form-floating">
					<textarea class="form-control" placeholder="Leave a comment here" id="medicine_description" name="medicine_description" style="height: 150px" required><?php echo $medicine_description; ?></textarea>
					<label for="medicine_description">Descripción</label>
				</div>
				<div class="d-flex justify-content-center gap-4 mt-3">
					<button type="submit" class="btn btn-success w-25">Editar</button>
					<a href="index.php" class="btn btn-danger w-25">Cancelar</a>
				</div>
		</form>
	<?php } else { ?>
		<div class="container">
			<div id="alert"></div>
			<?php if (isset($error)) { ?>
				<div class="d-flex">
					<a href="edit.php?medicine_id=<?php echo $medicine_id; ?>" class="btn btn-success d-block w-25 mt-5 mb-0 mx-auto">Editar Registro</a>
					<a href="index.php" class="btn btn-danger d-block w-25 mt-5 mb-0 mx-auto">Volver</a>
				</div>
			<?php } else { ?>
				<a href="index.php" class="btn btn-success d-block w-50 mt-5 mb-0 mx-auto">Volver</a>
			<?php } ?>
		</div>
	<?php } ?>
</main>
<?php include '../../includes/footer.php'; ?>