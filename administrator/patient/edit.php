<?php
$page = 'Editar Paciente';
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
	$pat_id = $_GET['pat_id'];

	try {
		$query = 'SELECT * FROM patients WHERE pat_id = :pat_id';

		$request = $connection->prepare($query);
		$request->bindParam(':pat_id', $pat_id);
		$request->execute();

		$resultPat = $request->fetch(PDO::FETCH_LAZY);
		$pat_document = $resultPat['pat_document'];
		$pat_firstName = $resultPat['pat_firstName'];
		$pat_secondName = $resultPat['pat_secondName'];
		$pat_firstLastName = $resultPat['pat_firstLastName'];
		$pat_secondLastName = $resultPat['pat_secondLastName'];
		$gender_id = $resultPat['gender_id'];
		$pat_email  = $resultPat['pat_email'];
		$pat_number = $resultPat['pat_number'];
	} catch (Exception $error) {
		echo $error;
	}
}

// UPDATE
if ($_POST) {
	$pat_document =  $_POST['pat_document'];
	$pat_firstName = ucfirst($_POST['pat_firstName']);
	$pat_secondName = ucfirst($_POST['pat_secondName']);
	$pat_firstLastName = ucfirst($_POST['pat_firstLastName']);
	$pat_secondLastName = ucfirst($_POST['pat_secondLastName']);
	$gender_id = $_POST['gender_id'];
	$pat_email = strtolower($_POST['pat_email']);
	$pat_number = $_POST['pat_number'];
	$pat_id = $_POST['pat_id'];

	try {
		$query =
			'UPDATE 
			patients 
		SET
			pat_document = :pat_document,
			pat_firstName = :pat_firstName, 
			pat_secondName = :pat_secondName,
			pat_firstLastName = :pat_firstLastName,
			pat_secondLastName = :pat_secondLastName, 
			gender_id = :gender_id, 
			pat_email = :pat_email,
			pat_number = :pat_number
		WHERE 
			pat_id = :pat_id';

		$request = $connection->prepare($query);
		$request->bindParam(':pat_document', $pat_document);
		$request->bindParam(':pat_firstName', $pat_firstName);
		$request->bindParam(':pat_secondName', $pat_secondName);
		$request->bindParam(':pat_firstLastName', $pat_firstLastName);
		$request->bindParam(':pat_secondLastName', $pat_secondLastName);
		$request->bindParam(':gender_id', $gender_id);
		$request->bindParam(':pat_email', $pat_email);
		$request->bindParam(':pat_number', $pat_number);
		$request->bindParam(':pat_id', $pat_id);

		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => {
			    showAlert('#alert', 'Registro editado correctamente');
			    redirect('$urlServer/administrator/patient/', 4000);
			});
		
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo realizar el registro. El documento \"$pat_document\" ya existe', 'error'));
		</script>
		";
	}
}
?>
<main>
	<?php if ($_GET) { ?>
		<form action="edit.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Edita Paciente</h1>
			<input type="hidden" name="pat_id" id="pat_id" value="<?php echo $pat_id; ?>">
			<div class="mt-4">
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="pat_firstName" class="input-group-text">Nombres</label>
						<input type="text" name="pat_firstName" id="pat_firstName" class="form-control" placeholder="Primero" value="<?php echo $pat_firstName ?>" required>
						<input type="text" name="pat_secondName" id="pat_secondName" class="form-control" placeholder="Segundo" value="<?php echo $pat_secondName ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="pat_firstLastName" class="input-group-text">Apellidos</label>
						<input type="text" name="pat_firstLastName" id="pat_firstLastName" class="form-control" placeholder="Primero" value="<?php echo $pat_firstLastName ?>" required>
						<input type="text" name="pat_secondLastName" id="pat_secondLastName" class="form-control" placeholder="Segundo" value="<?php echo $pat_secondLastName ?>">
					</div>
				</div>
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="pat_document" class="input-group-text">Documento</label>
						<input type="text" name="pat_document" id="document" class="form-control" placeholder="Número de Documento" required value="<?php echo $pat_document ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label class="input-group-text" for="pat_gender">Género</label>
						<select class="form-select" name="gender_id" id="pat_gender" required>
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
						<label for="pat_email" class="input-group-text">Email</label>
						<input type="email" name="pat_email" id="pat_email" class="form-control" placeholder="Correo Electrónico" value="<?php echo $pat_email ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="pat_number" class="input-group-text">Número de Teléfono</label>
						<input type="tel" name="pat_number" id="pat_number" class="form-control" placeholder="Puede ser fijo o móvil" value="<?php echo $pat_number ?>">
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
					<a href="edit.php?pat_id=<?php echo $pat_id; ?>" class="btn btn-success d-block w-25 mt-5 mb-0 mx-auto">Editar Registro</a>
					<a href="index.php" class="btn btn-danger d-block w-25 mt-5 mb-0 mx-auto">Volver</a>
				</div>
			<?php } else { ?>
				<a href="index.php" class="btn btn-success d-block w-50 mt-5 mb-0 mx-auto">Volver</a>
			<?php } ?>
		</div>
	<?php } ?>
</main>
<?php include '../../includes/footer.php'; ?>