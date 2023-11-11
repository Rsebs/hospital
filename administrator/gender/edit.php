<?php

$page = 'Editar Género';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

require '../../config/db.php';

// SELECT
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
	$gender_id = $_GET['gender_id'];

	try {
		$query = 'SELECT * FROM genders WHERE gender_id = :gender_id';

		$request = $connection->prepare($query);
		$request->bindParam(':gender_id', $gender_id);
		$request->execute();

		$resultDoc = $request->fetch(PDO::FETCH_LAZY);
		$gender_name = $resultDoc['gender_name'];
		$gender_cod = $resultDoc['gender_cod'];
	} catch (Exception $error) {
		echo $error;
	}
}

// UPDATE
if ($_POST) {
	$gender_name =  ucfirst($_POST['gender_name']);
	$gender_cod = ucfirst($_POST['gender_cod']);
	$gender_id = $_POST['gender_id'];

	try {
		$query =
			'UPDATE 
			genders 
		SET
			gender_name = :gender_name,
			gender_cod = :gender_cod
		WHERE 
			gender_id = :gender_id';

		$request = $connection->prepare($query);
		$request->bindParam(':gender_name', $gender_name);
		$request->bindParam(':gender_cod', $gender_cod);
		$request->bindParam(':gender_id', $gender_id);

		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => {
			    showAlert('#alert', 'Registro editado correctamente');
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
	<?php if ($_GET) { ?>

		<form action="edit.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Edita Género</h1>
			<input type="hidden" name="gender_id" id="gender_id" value="<?php echo $gender_id; ?>">
			<div class="mt-4 row">
				<div class="col-md input-group mb-4">
					<label for="gender_name" class="input-group-text">Nombre</label>
					<input type="text" name="gender_name" id="gender_name" class="form-control" placeholder="Ej: Masculino" value="<?php echo $gender_name; ?>" required>
				</div>
				<div class="col-md input-group mb-4">
					<label for="gender_cod" class="input-group-text">Código</label>
					<input type="text" name="gender_cod" id="gender_cod" class="form-control" placeholder="Ej: M" value="<?php echo $gender_cod; ?>" required>
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
					<a href="edit.php?gender_id=<?php echo $gender_id; ?>" class="btn btn-success d-block w-25 mt-5 mb-0 mx-auto">Editar Registro</a>
					<a href="index.php" class="btn btn-danger d-block w-25 mt-5 mb-0 mx-auto">Volver</a>
				</div>
			<?php } else { ?>
				<a href="index.php" class="btn btn-success d-block w-50 mt-5 mb-0 mx-auto">Volver</a>
			<?php } ?>
		</div>
	<?php } ?>
</main>
<?php include '../../includes/footer.php'; ?>