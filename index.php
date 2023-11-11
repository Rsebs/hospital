<?php
$page = 'Inicio';
include 'includes/head.php';
?>

<?php
include 'includes/functions.php';
validateSession();

require 'config/db.php';
include 'includes/urls.php';


// DELETE
if ($_POST) {
	$ordered_id = $_POST['ordered_id'];

	try {
		$query = 'DELETE FROM bills WHERE ordered_id = :ordered_id';

		$request = $connection->prepare($query);
		$request->bindParam(':ordered_id', $ordered_id);
		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Registro eliminado correctamente'));
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo eliminar el registro', 'error'));
		</script>
		";
	}
}

try {
	$query =
		'SELECT
		*
	FROM 
		bills b
	INNER JOIN 
		patients p ON p.pat_id = b.pat_id
	INNER JOIN 
		doctors d ON d.doc_id = b.doc_id
	INNER JOIN 
		medicines m ON m.medicine_id = b.medicine_id
	';

	$request = $connection->prepare($query);
	$request->execute();

	$resultPatient = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}

?>
<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="m-0">Facturas</p>
		</div>
		<div class="card-body">
			<a href="<?php echo $urlPatient; ?>" class="btn btn-primary">
				<img src="<?php echo $imgBillAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Crear una Factura</p>
			</a>
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered mt-3">
					<thead class="table-light">
						<tr>
							<th>ID Factura</th>
							<th>Paciente</th>
							<th>Doctor Responsable</th>
							<th>Receta</th>
							<th>Descripción</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($resultPatient->rowCount() > 0) {
							foreach ($resultPatient as $e) {
								echo '
									<tr>
										<td>' . $e['ordered_id'] . '</td>
										<td> (' . $e['pat_document'] . ') ' . $e['pat_firstName'] . ' ' . $e['pat_secondName'] . ' ' . $e['pat_firstLastName'] . ' ' . $e['pat_secondLastName'] . '</td>
										<td> (' . $e['doc_document'] . ') ' . $e['doc_firstName'] . ' ' . $e['doc_secondName'] . ' ' . $e['doc_firstLastName'] . ' ' . $e['doc_secondLastName'] . '</td>
										<td>' . $e['medicine_name'] . ' (' . $e['ordered_amount'] . ')</td>
										<td>' . $e['ordered_description'] . '</td>
										<td class="d-flex flex-sm-column flex-lg-row gap-2">
											<a href="seeBill.php?ordered_id=' . $e['ordered_id'] . '" title="Ver Factura" class="btn btn-primary">
												<img src="' . $imgEye . '" alt="image edit">
											</a>
											<form action="index.php" method="POST" data-type-form="delete">
												<input type="hidden" name="ordered_id" value="' . $e['ordered_id'] . '">
												<button type="submit" title="Borrar Factura" class="btn btn-danger">
													<img src="' . $imgRemove . '" alt="image remove">
												</button>
											</form>
										</td>
									</tr>
								';
							}
						} else {
							echo '
								<tr>
									<td class="text-center" colspan="6">Aún no hay datos</td>
								</tr>
							';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</main>
<?php include 'includes/footer.php'; ?>