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
	$id = $_POST['id'];

	try {
		$query = 'DELETE FROM bills WHERE id = :id';

		$request = $connection->prepare($query);
		$request->bindParam(':id', $id);
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
		b.id AS b_id,
		pat.document AS pat_document,
		pat.first_name AS pat_first_name,
		pat.second_name AS pat_second_name,
		pat.first_last_name AS pat_first_last_name,
		pat.second_last_name AS pat_second_last_name,
		per.document AS per_document,
		per.first_name AS per_first_name,
		per.second_name AS per_second_name,
		per.first_last_name AS per_first_last_name,
		per.second_last_name AS per_second_last_name,
		m.name AS m_name,
		b.amount AS b_amount,
		b.description AS b_description
	FROM 
		bills b
	INNER JOIN 
		patients pat ON pat.id = b.pat_id
	INNER JOIN 
		personals per ON per.id = b.per_id
	INNER JOIN 
		medicines m ON m.id = b.medicine_id
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
										<td>' . $e['b_id'] . '</td>
										<td> (' . $e['pat_document'] . ') ' . $e['pat_first_name'] . ' ' . $e['pat_second_name'] . ' ' . $e['pat_first_last_name'] . ' ' . $e['pat_second_last_name'] . '</td>
										<td> (' . $e['per_document'] . ') ' . $e['per_first_name'] . ' ' . $e['per_second_name'] . ' ' . $e['per_first_last_name'] . ' ' . $e['per_second_last_name'] . '</td>
										<td>' . $e['m_name'] . ' (' . $e['b_amount'] . ')</td>
										<td>' . $e['b_description'] . '</td>
										<td class="d-flex flex-sm-column flex-lg-row gap-2">
											<a href="seeBill.php?id=' . $e['b_id'] . '" title="Ver Factura" class="btn btn-primary">
												<img src="' . $imgEye . '" alt="image edit">
											</a>
											<form action="index.php" method="POST" data-type-form="delete">
												<input type="hidden" name="id" value="' . $e['b_id'] . '">
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