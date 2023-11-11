<?php
$page = 'Medicinas';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

include '../../includes/urls.php';
require '../../config/db.php';

// DELETE
if ($_POST) {
	$medicine_id = $_POST['medicine_id'];

	try {
		$query = 'DELETE FROM medicines WHERE medicine_id = :medicine_id';

		$request = $connection->prepare($query);
		$request->bindParam(':medicine_id', $medicine_id);
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
	$query = 'SELECT * FROM medicines';

	$request = $connection->prepare($query);
	$request->execute();

	$resultMedicine = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}

?>

<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="m-0">Medicina</p>
		</div>
		<div class="card-body">
			<a href="create.php" class="btn btn-primary">
				<img src="<?php echo $imgAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Medicina</p>
			</a>
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered mt-3">
					<thead class="table-light">
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($resultMedicine->rowCount() > 0) {
							foreach ($resultMedicine as $e) {
								echo '
									<tr>
										<td>' . $e['medicine_id'] . '</td>
										<td>' . $e['medicine_name'] . '</td>
										<td>' . $e['medicine_description'] . '</td>
										<td class="d-flex flex-sm-column flex-lg-row gap-2">
											<a href="edit.php?medicine_id=' . $e['medicine_id'] . '" title="Editar Medicina" class="btn btn-success">
												<img src="' . $imgEdit . '" alt="image edit">
											</a>
											<form action="index.php" method="POST" data-type-form="delete">
												<input type="hidden" name="medicine_id" value="' . $e['medicine_id'] . '">
												<button type="submit" title="Borrar Medicina" class="btn btn-danger">
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