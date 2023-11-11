<?php
$page = 'Factura';
include 'includes/head.php';
?>

<?php
include 'includes/functions.php';
validateSession();

require 'config/db.php';

// SELECT patients
if ($_GET) {
	$ordered_id  = $_GET['ordered_id'];

	try {
		$query =
			'SELECT *
			FROM bills b
			INNER JOIN patients p ON p.pat_id = b.pat_id
			INNER JOIN doctors d ON d.doc_id = b.doc_id
			INNER JOIN medicines m ON m.medicine_id = b.medicine_id
			WHERE ordered_id = :ordered_id';

		$request = $connection->prepare($query);
		$request->bindParam(':ordered_id', $ordered_id);
		$request->execute();

		$resultBill = $request->fetch(PDO::FETCH_LAZY);
	} catch (Exception $error) {
		echo $error;
	}
}
?>
<main class="container">
	<h1 class="fs-2 text-center">Factura de Paciente</h1>
	<div class="mt-4 seeBill">
		<fieldset class="mb-4 px-4 py-2">
			<legend class="mb-4">
				<h2 class="fs-4 my-2 py-2">Información del Paciente</h2>
			</legend>
			<div class="row align-items-center">
				<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
				<p class="mb-4 col-8 col-lg"> <?php echo $resultBill['pat_firstName'] . ' ' . $resultBill['pat_secondName'] . ' ' . $resultBill['pat_firstLastName'] . ' ' . $resultBill['pat_secondLastName'] ?></p>
				<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['pat_document'] ?></p>
			</div>
			<div class="row align-items-center">
				<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['pat_email'] ?></p>
				<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['pat_number'] ?></p>
			</div>
		</fieldset>
		<fieldset class="mb-4 px-4 py-2">
			<legend class="mb-4">
				<h2 class="fs-4 my-2 py-2">Información del Doctor Responsable</h2>
			</legend>
			<div class="row align-items-center">
				<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
				<p class="mb-4 col-8 col-lg"> <?php echo $resultBill['doc_firstName'] . ' ' . $resultBill['doc_secondName'] . ' ' . $resultBill['doc_firstLastName'] . ' ' . $resultBill['doc_secondLastName'] ?></p>
				<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['doc_document'] ?></p>
			</div>
			<div class="row align-items-center">
				<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['doc_email'] ?></p>
				<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['doc_number'] ?></p>
			</div>
		</fieldset>
		<fieldset class="mb-4 px-4 pt-2 pb-4">
			<legend class="mb-4">
				<h2 class="fs-4 my-2 py-2">Información de la Factura</h2>
			</legend>
			<div class="row align-items-center">
				<p class="mb-4 col-4 col-lg-2 fw-bold">Medicina Recetada:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['medicine_name'] ?></p>
				<p class="mb-4 col-4 col-lg-2 fw-bold">Cantidad:</p>
				<p class="mb-4 col-8 col-lg"><?php echo $resultBill['ordered_amount'] ?></p>
			</div>
			<div class="form-floating">
				<textarea class="form-control" placeholder="Leave a comment here" id="ordered_description" name="ordered_description" style="height: 200px" readonly><?php echo $resultBill['ordered_description']; ?></textarea>
				<label for="ordered_description">Descripción de la Receta</label>
			</div>
		</fieldset>
	</div>
	<div class="d-flex justify-content-center gap-4 mt-3">
		<a href="index.php" class="btn btn-primary w-25">Volver</a>
	</div>
	</form>
</main>

<?php include 'includes/footer.php'; ?>