<?php
$page = 'Género';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

include '../../includes/urls.php';
require '../../config/db.php';

// DELETE 
if ($_POST) {
	$gender_id = $_POST['gender_id'];

	try {
		$query = 'DELETE FROM genders WHERE gender_id = :gender_id';

		$request = $connection->prepare($query);
		$request->bindParam(':gender_id', $gender_id);
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
	$query = 'SELECT * FROM genders';

	$request = $connection->prepare($query);
	$request->execute();

	$resultGender = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}

?>

<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="m-0">Género</p>
		</div>
		<div class="card-body">
			<a href="create.php" class="btn btn-primary">
				<img src="<?php echo $imgAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Género</p>
			</a>
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered mt-3">
					<thead class="table-light">
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Código</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($resultGender->rowCount() > 0) {
							foreach ($resultGender as $e) {
								echo '
									<tr>
										<td>' . $e['gender_id'] . '</td>
										<td>' . $e['gender_name'] . '</td>
										<td>' . $e['gender_cod'] . '</td>
										<td class="d-flex flex-sm-column flex-lg-row gap-2">
											<a href="edit.php?gender_id=' . $e['gender_id'] . '" title="Editar Género" class="btn btn-success">
												<img src="' . $imgEdit . '" alt="image edit">
											</a>
											<form action="index.php" method="POST" data-type-form="delete">
												<input type="hidden" name="gender_id" value="' . $e['gender_id'] . '">
												<button type="submit" title="Borrar Género" class="btn btn-danger">
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