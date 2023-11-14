<?php
$page = 'Pacientes';
include '../../includes/head.php';

include '../../includes/functions.php';
validateSession();
?>

<?php

require '../../config/db.php';
include '../../includes/urls.php';

try {
	$query = 'SELECT p.*, g.name AS gender_name FROM patients p INNER JOIN genders g ON p.gender_id = g.id';

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
			<a href="create.php" class="btn btn-primary mb-3">
				<img src="<?php echo $imgUserAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Paciente</p>
			</a>
			<?php
			include '../../includes/components/alerts.php';
			?>

			<form action="#" method="post">
				<input type="text" class="form-control" id="filter" name="filter" placeholder="Buscar">
			</form>
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
					<tbody id="content"></tbody>
				</table>
			</div>
		</div>
	</div>
</main>

<?php include '../../includes/footer.php'; ?>