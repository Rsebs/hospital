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
	$id = $_GET['id'];

	try {
		$query = 'SELECT * FROM patients WHERE id = :id';

		$request = $connection->prepare($query);
		$request->bindParam(':id', $id);
		$request->execute();

		$resultPat = $request->fetch(PDO::FETCH_LAZY);
		$document = $resultPat['document'];
		$first_name = $resultPat['first_name'];
		$second_name = $resultPat['second_name'];
		$first_last_name = $resultPat['first_last_name'];
		$second_last_name = $resultPat['second_last_name'];
		$gender_id = $resultPat['gender_id'];
		$email  = $resultPat['email'];
		$contact_number = $resultPat['contact_number'];
	} catch (Exception $error) {
		echo $error;
	}
}

// UPDATE
if ($_POST) {
	$document =  $_POST['document'];
	$first_name = ucfirst($_POST['first_name']);
	$second_name = ucfirst($_POST['second_name']);
	$first_last_name = ucfirst($_POST['first_last_name']);
	$second_last_name = ucfirst($_POST['second_last_name']);
	$gender_id = $_POST['gender_id'];
	$email = strtolower($_POST['email']);
	$contact_number = $_POST['contact_number'];
	$id = $_POST['id'];

	try {
		$query =
			'UPDATE 
			patients 
		SET
			document = :document,
			first_name = :first_name, 
			second_name = :second_name,
			first_last_name = :first_last_name,
			second_last_name = :second_last_name, 
			gender_id = :gender_id, 
			email = :email,
			contact_number = :contact_number
		WHERE 
			id = :id';

		$request = $connection->prepare($query);
		$request->bindParam(':document', $document);
		$request->bindParam(':first_name', $first_name);
		$request->bindParam(':second_name', $second_name);
		$request->bindParam(':first_last_name', $first_last_name);
		$request->bindParam(':second_last_name', $second_last_name);
		$request->bindParam(':gender_id', $gender_id);
		$request->bindParam(':email', $email);
		$request->bindParam(':contact_number', $contact_number);
		$request->bindParam(':id', $id);

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
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo realizar el registro. El documento \"$document\" ya existe', 'error'));
		</script>
		";
	}
}
?>
<main>
	<?php if ($_GET) { ?>
		<form action="edit.php" method="POST" class="container">
			<h1 class="fs-2 text-center">Edita Paciente</h1>
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			<div class="mt-4">
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="first_name" class="input-group-text">Nombres</label>
						<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Primero" value="<?php echo $first_name ?>" required>
						<input type="text" name="second_name" id="second_name" class="form-control" placeholder="Segundo" value="<?php echo $second_name ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="first_last_name" class="input-group-text">Apellidos</label>
						<input type="text" name="first_last_name" id="first_last_name" class="form-control" placeholder="Primero" value="<?php echo $first_last_name ?>" required>
						<input type="text" name="second_last_name" id="second_last_name" class="form-control" placeholder="Segundo" value="<?php echo $second_last_name ?>">
					</div>
				</div>
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="document" class="input-group-text">Documento</label>
						<input type="text" name="document" id="document" class="form-control" placeholder="Número de Documento" required value="<?php echo $document ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label class="input-group-text" for="gender">Género</label>
						<select class="form-select" name="gender_id" id="gender" required>
							<option value="" selected disabled>-- Selecciona --</option>
							<?php
							foreach ($resultGenders as $e) {
								if ($e['id'] === $gender_id) {
									echo '<option value="' . $e['id'] . '" selected>' . $e['name'] . '</option>';
								} else {
									echo '<option value="' . $e['id'] . '">' . $e['name'] . '</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="input-group mb-4 col-lg">
						<label for="email" class="input-group-text">Email</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" value="<?php echo $email ?>">
					</div>
					<div class="input-group mb-4 col-lg">
						<label for="contact_number" class="input-group-text">Número de Teléfono</label>
						<input type="tel" name="contact_number" id="contact_number" class="form-control" placeholder="Puede ser fijo o móvil" value="<?php echo $contact_number ?>">
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
					<a href="edit.php?id=<?php echo $id; ?>" class="btn btn-success d-block w-25 mt-5 mb-0 mx-auto">Editar Registro</a>
					<a href="index.php" class="btn btn-danger d-block w-25 mt-5 mb-0 mx-auto">Volver</a>
				</div>
			<?php } else { ?>
				<a href="index.php" class="btn btn-success d-block w-50 mt-5 mb-0 mx-auto">Volver</a>
			<?php } ?>
		</div>
	<?php } ?>
</main>
<?php include '../../includes/footer.php'; ?>