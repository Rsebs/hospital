<?php

$page = 'Editar Personal';
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
	$doc_id = $_GET['doc_id'];

	try {
		$query = 'SELECT * FROM doctors WHERE doc_id = :doc_id';

		$request = $connection->prepare($query);
		$request->bindParam(':doc_id', $doc_id);
		$request->execute();

		$resultDoc = $request->fetch(PDO::FETCH_LAZY);
		$doc_document = $resultDoc['doc_document'];
		$doc_firstName = $resultDoc['doc_firstName'];
		$doc_secondName = $resultDoc['doc_secondName'];
		$doc_firstLastName = $resultDoc['doc_firstLastName'];
		$doc_secondLastName = $resultDoc['doc_secondLastName'];
		$gender_id = $resultDoc['gender_id'];
		$doc_email  = $resultDoc['doc_email'];
		$doc_number = $resultDoc['doc_number'];
	} catch (Exception $error) {
		echo $error;
	}
}

if ($_POST) {
	$doc_document =  $_POST['doc_document'];
	$doc_firstName = ucfirst($_POST['doc_firstName']);
	$doc_secondName = ucfirst($_POST['doc_secondName']);
	$doc_firstLastName = ucfirst($_POST['doc_firstLastName']);
	$doc_secondLastName = ucfirst($_POST['doc_secondLastName']);
	$gender_id = $_POST['gender_id'];
	$doc_email = strtolower($_POST['doc_email']);
	$doc_number = $_POST['doc_number'];
	$doc_id = $_POST['doc_id'];

	try {
		$query =
			'UPDATE 
			doctors 
		SET
			doc_document = :doc_document,
			doc_firstName = :doc_firstName, 
			doc_secondName = :doc_secondName,
			doc_firstLastName = :doc_firstLastName,
			doc_secondLastName = :doc_secondLastName, 
			gender_id = :gender_id, 
			doc_email = :doc_email,
			doc_number = :doc_number
		WHERE 
			doc_id = :doc_id';

		$request = $connection->prepare($query);
		$request->bindParam(':doc_document', $doc_document);
		$request->bindParam(':doc_firstName', $doc_firstName);
		$request->bindParam(':doc_secondName', $doc_secondName);
		$request->bindParam(':doc_firstLastName', $doc_firstLastName);
		$request->bindParam(':doc_secondLastName', $doc_secondLastName);
		$request->bindParam(':gender_id', $gender_id);
		$request->bindParam(':doc_email', $doc_email);
		$request->bindParam(':doc_number', $doc_number);
		$request->bindParam(':doc_id', $doc_id);

		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => {
			    showAlert('#alert', 'Registro editado correctamente');
			    redirect('$urlServer/administrator/personal/', 4000);
			});
		
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo realizar el registro. El documento \"$doc_document\" ya existe', 'error'));
		</script>
		";
	}
}
?>
<main>
	<?php if ($_GET) { ?>
		<form action="edit.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Edita Personal</h1>
			<input type="hidden" name="doc_id" id="doc_id" value="<?php echo $doc_id; ?>">
			<div class="mt-4">
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="doc_firstName" class="input-group-text">Nombres</label>
						<input type="text" name="doc_firstName" id="doc_firstName" class="form-control" placeholder="Primero" value="<?php echo $doc_firstName ?>" required>
						<input type="text" name="doc_secondName" id="doc_secondName" class="form-control" placeholder="Segundo" value="<?php echo $doc_secondName ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="doc_firstLastName" class="input-group-text">Apellidos</label>
						<input type="text" name="doc_firstLastName" id="doc_firstLastName" class="form-control" placeholder="Primero" value="<?php echo $doc_firstLastName ?>" required>
						<input type="text" name="doc_secondLastName" id="doc_secondLastName" class="form-control" placeholder="Segundo" value="<?php echo $doc_secondLastName ?>">
					</div>
				</div>
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="doc_document" class="input-group-text">Documento</label>
						<input type="text" name="doc_document" id="document" class="form-control" placeholder="Número de Documento" required value="<?php echo $doc_document ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label class="input-group-text" for="doc_gender">Género</label>
						<select class="form-select" name="gender_id" id="doc_gender" required>
							<option value="" selected disabled>-- Selecciona --</option>
							<?php
							foreach ($resultGenders as $e) {
								if ($e['gender_id'] === $gender_id) {
									echo '<option value="' . $e['gender_id'] . '" selected>' . $e['gender_name'] . '</option>';
								} else {
									echo '<option value="' . $e['gender_id'] . '">' . $e['gender_name'] . '</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="doc_email" class="input-group-text">Email</label>
						<input type="email" name="doc_email" id="doc_email" class="form-control" placeholder="Correo Electrónico" value="<?php echo $doc_email ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="doc_number" class="input-group-text">Número de Teléfono</label>
						<input type="tel" name="doc_number" id="doc_number" class="form-control" placeholder="Puede ser fijo o móvil" value="<?php echo $doc_number ?>">
					</div>
				</div>
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
					<a href="edit.php?doc_id=<?php echo $doc_id; ?>" class="btn btn-success d-block w-25 mt-5 mb-0 mx-auto">Editar Registro</a>
					<a href="index.php" class="btn btn-danger d-block w-25 mt-5 mb-0 mx-auto">Volver</a>
				</div>
			<?php } else { ?>
				<a href="index.php" class="btn btn-success d-block w-50 mt-5 mb-0 mx-auto">Volver</a>
			<?php } ?>
		</div>
	<?php } ?>
</main>
<?php include '../../includes/footer.php'; ?>