<?php
$page = 'Agregar Paciente';
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
	echo $error->getMessage();
}

// INSERT
if ($_POST) {
	$pat_document =  $_POST['pat_document'];
	$pat_firstName = ucfirst($_POST['pat_firstName']);
	$pat_secondName = ucfirst($_POST['pat_secondName']);
	$pat_firstLastName = ucfirst($_POST['pat_firstLastName']);
	$pat_secondLastName = ucfirst($_POST['pat_secondLastName']);
	$gender_id = $_POST['gender_id'];
	$pat_email = strtolower($_POST['pat_email']);
	$pat_number = $_POST['pat_number'];

	try {
		$query =
			'INSERT INTO 
			patients 
		VALUES(
			NULL, 
			:pat_document, 
			:pat_firstName, 
			:pat_secondName,
			:pat_firstLastName,
			:pat_secondLastName, 
			:gender_id, 
			:pat_email,
			:pat_number,
			NULL
		)';

		$request = $connection->prepare($query);
		$request->bindParam(':pat_document', $pat_document);
		$request->bindParam(':pat_firstName', $pat_firstName);
		$request->bindParam(':pat_secondName', $pat_secondName);
		$request->bindParam(':pat_firstLastName', $pat_firstLastName);
		$request->bindParam(':pat_secondLastName', $pat_secondLastName);
		$request->bindParam(':gender_id', $gender_id);
		$request->bindParam(':pat_email', $pat_email);
		$request->bindParam(':pat_number', $pat_number);

		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => {
			    showAlert('#alert', 'Registro agregado correctamente');
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
	<?php if (!$_POST) { ?>
		<form action="create.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Agrega Nuevo Paciente</h1>
			<div class="mt-4">
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="pat_firstName" class="input-group-text">Nombres</label>
						<input type="text" name="pat_firstName" id="pat_firstName" class="form-control" placeholder="Primero" required>
						<input type="text" name="pat_secondName" id="pat_secondName" class="form-control" placeholder="Segundo">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="pat_firstLastName" class="input-group-text">Apellidos</label>
						<input type="text" name="pat_firstLastName" id="pat_firstLastName" class="form-control" placeholder="Primero" required>
						<input type="text" name="pat_secondLastName" id="pat_secondLastName" class="form-control" placeholder="Segundo">
					</div>
				</div>
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="pat_document" class="input-group-text">Documento</label>
						<input type="text" name="pat_document" id="document" class="form-control" placeholder="Número de patumento" required>
					</div>
					<div class="input-group mb-4 col-lg">
						<label class="input-group-text" for="pat_gender">Género</label>
						<select class="form-select" name="gender_id" id="pat_gender" required>
							<option value="" selected disabled>-- Selecciona --</option>
							<?php
							foreach ($resultGenders as $e) {
								echo '<option value="' . $e['gender_id'] . '">' . $e['gender_name'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="pat_email" class="input-group-text">Email</label>
						<input type="email" name="pat_email" id="pat_email" class="form-control" placeholder="Correo Electrónico">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="pat_number" class="input-group-text">Número de Teléfono</label>
						<input type="tel" name="pat_number" id="pat_number" class="form-control" placeholder="Puede ser fijo o móvil">
					</div>
				</div>
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