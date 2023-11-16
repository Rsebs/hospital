<?php
$page = 'Personal';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

include '../../includes/urls.php';
include '../../config/db.php';

// Elimina un registro
if ($_POST) {
	$doc_id = $_POST['doc_id'];

	try {
		$query = 'DELETE FROM personals WHERE doc_id = :doc_id';

		$request = $connection->prepare($query);
		$request->bindParam(':doc_id', $doc_id);
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
	$query = 'SELECT p.*, g.name FROM personals p INNER JOIN genders g ON p.gender_id = g.id';

	$request = $connection->prepare($query);
	$request->execute();

	$resultDoctor = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}

?>

<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="m-0">Personal</p>
		</div>
		<div class="card-body">
			<a href="create.php" class="btn btn-primary">
				<img src="<?php echo $imgUserAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Personal</p>
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
						if ($resultDoctor->rowCount() > 0) {
							foreach ($resultDoctor as $e) {
								echo '
									<tr>
										<td>' . $e['doc_document'] . '</td>
										<td>' . $e['doc_firstName'] . ' ' . $e['doc_secondName'] . ' ' . $e['doc_firstLastName'] . ' ' . $e['doc_secondLastName'] . '</td>
										<td>' . $e['gender_name'] . '</td>
										<td>' . $e['doc_email'] . '</td>
										<td>' . $e['doc_number'] . '</td>
										<td class="d-flex flex-sm-column flex-lg-row gap-2">
											<a href="edit.php?doc_id=' . $e['doc_id'] . '" title="Editar Personal" class="btn btn-success">
												<img src="' . $imgEdit . '" alt="image edit">
											</a>
											<form action="index.php" method="POST" data-type-form="delete">
												<input type="hidden" name="doc_id" value="' . $e['doc_id'] . '">
												<button type="submit" title="Borrar Personal" class="btn btn-danger">
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