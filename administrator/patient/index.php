<?php
$page = 'Pacientes';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

require '../../config/db.php';
include '../../includes/urls.php';

// DELETE
if ($_POST) {
	$pat_id = $_POST['pat_id'];

	try {
		$query = 'DELETE FROM patients WHERE pat_id = :pat_id';

		$request = $connection->prepare($query);
		$request->bindParam(':pat_id', $pat_id);
		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Registro eliminado correctamente'));
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo eliminar el registro, contacta para más información', 'error'));
		</script>
		";
	}
}

try {
	$query = 'SELECT p.*, g.gender_name FROM patients p INNER JOIN genders g ON p.gender_id = g.gender_id';

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
			<p class="m-0">Pacientes</p>
		</div>
		<div class="card-body">
			<a href="create.php" class="btn btn-primary">
				<img src="<?php echo $imgUserAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Paciente</p>
			</a>
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered mt-3">
					<thead class="table-light">
						<tr>
							<th>Número de documento</th>
							<th>Nombre</th>
							<th>Género</th>
							<th>Email</th>
							<th>Número de teléfono</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($resultPatient->rowCount() > 0) {
							foreach ($resultPatient as $e) {
								echo '
									<tr>
										<td>' . $e['pat_document'] . '</td>
										<td>' . $e['pat_firstName'] . ' ' . $e['pat_secondName'] . ' ' . $e['pat_firstLastName'] . ' ' . $e['pat_secondLastName'] . '</td>
										<td>' . $e['gender_name'] . '</td>
										<td>' . $e['pat_email'] . '</td>
										<td>' . $e['pat_number'] . '</td>
										<td class="d-flex flex-sm-column flex-lg-row gap-2">
											<a href="createBill.php?pat_id=' . $e['pat_id'] . '" title="Crear Factura" class="btn btn-secondary">
												<img src="' . $imgBillAdd . '" alt="image edit">
											</a>
											<a href="edit.php?pat_id=' . $e['pat_id'] . '" title="Editar Factura" class="btn btn-success">
												<img src="' . $imgEdit . '" alt="image edit">
											</a>
											<form action="index.php" method="POST" data-type-form="delete">
												<input type="hidden" name="pat_id" value="' . $e['pat_id'] . '">
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

<?php include '../../includes/footer.php'; ?>