<?php
$page = 'Crear Factura';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

require '../../config/db.php';

try {
	// Doctors
	$query = 'SELECT * FROM personals';

	$request = $connection->prepare($query);
	$request->execute();

	$resultDoctors = $connection->query($query);

	// Medicines
	$query = 'SELECT * FROM medicines';

	$request = $connection->prepare($query);
	$request->execute();

	$resultMedicines = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}


// SELECT
if ($_GET) {
	$id = $_GET['id'];

	try {
		$query =
			'SELECT 
			p.*,
			g.name AS gender_name
		FROM 
			patients p 
		INNER JOIN 
			genders g ON g.id = p.gender_id
		WHERE 
			p.id = :id';

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
		$gender_name = $resultPat['gender_name'];
	} catch (Exception $error) {
		echo $error;
	}
}


?>

<main class="container">
		<form action="<?= $patientController ?>/createBill.php" method="POST">
			<h1 class="fs-2 text-center">Crear Factura de Paciente</h1>
			<input type="hidden" name="id" id="id" value="<?= $id ?>">
			<div class="mt-4">
				<fieldset>
					<legend class="text-secondary mb-4">Información del Paciente</legend>
					<div class="row align-items-center">
						<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
						<p class="mb-4 col-8 col-lg"> <?= $first_name . ' ' . $second_name . ' ' . $first_last_name . ' ' . $second_last_name ?></p>
						<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
						<p class="mb-4 col-8 col-lg"><?= $document ?></p>
					</div>
					<div class="row align-items-center">
						<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
						<p class="mb-4 col-8 col-lg"><?= $email ?></p>
						<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
						<p class="mb-4 col-8 col-lg"><?= $contact_number ?></p>
					</div>
					<div class="row align-items-center">
						<p class="mb-4 col-4 col-lg-2 fw-bold">Género:</p>
						<p class="mb-4 col-8 col-lg"><?= $gender_name ?></p>
					</div>
				</fieldset>
				<fieldset>
					<legend class="text-secondary mb-4">Información de la Factura</legend>
					<div class="input-group mb-4 col-lg">
						<label class="input-group-text" for="doc_id">Doctor Responsable</label>
						<select class="form-select" name="doc_id" id="doc_id" required>
							<option value="" selected disabled>-- Selecciona --</option>
							<?php
							foreach ($resultDoctors as $e) {
								echo '<option value="' . $e['id'] . '">' . $e['first_name'] . ' ' . $e['second_name'] . ' ' . $e['first_last_name'] . ' (' . $e['document'] . ')' . '</option>';
							}
							?>
						</select>
					</div>
					<div class="row">
						<div class="input-group mb-4 col-lg">
							<label class="input-group-text" for="medicine_id">Medicina Recetada</label>
							<select class="form-select" name="medicine_id" id="medicine_id" required>
								<option value="" selected disabled>-- Selecciona --</option>
								<?php
								foreach ($resultMedicines as $e) {
									echo '<option value="' . $e['id'] . '">' . $e['name'] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="input-group mb-4 col-lg">
							<label for="amount" class="input-group-text">Cantidad</label>
							<input type="contact_number" name="amount" id="amount" class="form-control" placeholder="Cantidad Recetada" min="1" required>
						</div>
					</div>
					<div class="form-floating">
						<textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 200px" required></textarea>
						<label for="description">Descripción de la Receta</label>
					</div>
				</fieldset>
			</div>
			<div class="d-flex justify-content-center gap-4 mt-3">
				<button type="submit" class="btn btn-success w-25">Guardar Factura</button>
				<a href="index.php" class="btn btn-danger w-25">Cancelar</a>
			</div>
		</form>
</main>

<?php include '../../includes/footer.php'; ?>