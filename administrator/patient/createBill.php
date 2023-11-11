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
	$query = 'SELECT * FROM doctors';

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
	$pat_id = $_GET['pat_id'];

	try {
		$query =
			'SELECT 
			p.*,
			g.gender_name
		FROM 
			patients p 
		INNER JOIN 
			genders g ON g.gender_id = p.gender_id
		WHERE 
			pat_id = :pat_id';

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
		$gender_name = $resultPat['gender_name'];
	} catch (Exception $error) {
		echo $error;
	}
}

// INSERT
if ($_POST) {
	$pat_id = $_POST['pat_id'];
	$doc_id = $_POST['doc_id'];
	$medicine_id = $_POST['medicine_id'];
	$ordered_description = $_POST['ordered_description'];
	$ordered_amount = $_POST['ordered_amount'];

	try {
		$query = 'INSERT INTO bills VALUES (NULL, :pat_id, :doc_id, :medicine_id, :ordered_description, :ordered_amount)';

		$request = $connection->prepare($query);
		$request->bindParam(':pat_id', $pat_id);
		$request->bindParam(':doc_id', $doc_id);
		$request->bindParam(':medicine_id', $medicine_id);
		$request->bindParam(':ordered_description', $ordered_description);
		$request->bindParam(':ordered_amount', $ordered_amount);

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
		echo $error;
	}
}
?>

<main class="container">
	<?php if ($_GET) { ?>
		<form action="createBill.php" method="POST">
			<h1 class="fs-2 text-center">Crear Factura de Paciente</h1>
			<input type="hidden" name="pat_id" id="pat_id" value="<?php echo $pat_id; ?>">
			<div class="mt-4">
				<fieldset>
					<legend class="text-secondary mb-4">Información del Paciente</legend>
					<div class="row align-items-center">
						<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
						<p class="mb-4 col-8 col-lg"> <?php echo $pat_firstName . ' ' . $pat_secondName . ' ' . $pat_firstLastName . ' ' . $pat_secondLastName ?></p>
						<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
						<p class="mb-4 col-8 col-lg"><?php echo $pat_document ?></p>
					</div>
					<div class="row align-items-center">
						<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
						<p class="mb-4 col-8 col-lg"><?php echo $pat_email ?></p>
						<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
						<p class="mb-4 col-8 col-lg"><?php echo $pat_number ?></p>
					</div>
					<div class="row align-items-center">
						<p class="mb-4 col-4 col-lg-2 fw-bold">Género:</p>
						<p class="mb-4 col-8 col-lg"><?php echo $gender_name ?></p>
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
								echo '<option value="' . $e['doc_id'] . '">' . $e['doc_firstName'] . ' ' . $e['doc_secondName'] . ' ' . $e['doc_firstLastName'] . ' (' . $e['doc_document'] . ')' . '</option>';
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
									echo '<option value="' . $e['medicine_id'] . '">' . $e['medicine_name'] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="input-group mb-4 col-lg">
							<label for="ordered_amount" class="input-group-text">Cantidad</label>
							<input type="number" name="ordered_amount" id="ordered_amount" class="form-control" placeholder="Cantidad Recetada" min="1" required>
						</div>
					</div>
					<div class="form-floating">
						<textarea class="form-control" placeholder="Leave a comment here" id="ordered_description" name="ordered_description" style="height: 200px" required></textarea>
						<label for="ordered_description">Descripción de la Receta</label>
					</div>
				</fieldset>
			</div>
			<div class="d-flex justify-content-center gap-4 mt-3">
				<button type="submit" class="btn btn-success w-25">Guardar Factura</button>
				<a href="index.php" class="btn btn-danger w-25">Cancelar</a>
			</div>
		</form>
	<?php } else { ?>
		<div id="alert"></div>
		<a href="index.php" class="btn btn-success d-block w-50 mt-5 mb-0 mx-auto">Volver</a>
	<?php } ?>
</main>

<?php include '../../includes/footer.php'; ?>