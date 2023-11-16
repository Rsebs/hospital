<?php
$page = 'Personal';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

include '../../includes/urls.php';
include '../../config/db.php';

try {
	$query = 'SELECT p.*, g.name FROM personals p INNER JOIN genders g ON p.gender_id = g.id';

	$request = $connection->prepare($query);
	$request->execute();

	$resultDoctor = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}

$query = 'SELECT * FROM genders';
$resultGenders = $connection->query($query);
$optionGender = '';
foreach ($resultGenders as $g) {
	$optionGender .= '<option value="' . $g['id'] . '">' . $g['name'] . '</option>';
}

?>
<input type="hidden" value="personal" id="controller">
<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="my-1 text-center fs-5">Personal</p>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-create">
				<img src="<?= $imgUserAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Personal</p>
			</button>
			<?php
			include '../../includes/components/alerts.php';
			?>
			<div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
				<div class="form-floating d-flex gap-4 flex-grow-1">
					<input type="text" class="form-control" id="filter" placeholder="">
					<label for="filter">Buscar</label>
					<div class="spinner-border" role="status" id="spinner">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
				<div class="form-floating flex-fill">
					<select class="form-select" id="select_limit" aria-label="Floating label select example">
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
					</select>
					<label for="select_limit">Cantidad de registros</label>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered mt-3">
					<thead class="table-light">
						<tr>
							<th>Número de documento</th>
							<th>Nombre</th>
							<th>Género</th>
							<th>Email</th>
							<th>Número de teléfono</th>
							<th>Fecha de Ingreso</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="content"></tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-6">
					<label id="total_registers"></label>
				</div>
				<div class="col-6" id="nav-pagination"></div>
			</div>
		</div>
	</div>
</main>
<form action="<?= $personalController ?>/create.php" method="POST" class="container">
	<div class="modal fade" id="modal-create" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5">Agregar Registro</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mt-4">
						<div class="row">
							<div class="input-group mb-4 col-lg">
								<label for="first_name" class="input-group-text">Nombres</label>
								<input type="text" name="first_name" class="form-control" placeholder="Primero" required>
								<input type="text" name="second_name" class="form-control" placeholder="Segundo">
							</div>
							<div class="input-group mb-4 col-lg">
								<label for="first_last_name" class="input-group-text">Apellidos</label>
								<input type="text" name="first_last_name" class="form-control" placeholder="Primero" required>
								<input type="text" name="second_last_name" class="form-control" placeholder="Segundo">
							</div>
						</div>
						<div class="row">
							<div class="input-group mb-4 col-lg">
								<label for="document" class="input-group-text">Documento</label>
								<input type="text" name="document" class="form-control" placeholder="Número de Documento" required>
							</div>
							<div class="input-group mb-4 col-lg">
								<label class="input-group-text" for="gender">Género</label>
								<select class="form-select" name="gender_id" id="gender" required>
									<option value="" selected disabled>-- Selecciona --</option>
									<?= $optionGender ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="input-group mb-4 col-lg">
								<label for="email" class="input-group-text">Email</label>
								<input type="email" name="email" class="form-control" placeholder="Correo Electrónico">
							</div>
							<div class="input-group mb-4 col-lg">
								<label for="contact_number" class="input-group-text">Número de Teléfono</label>
								<input type="tel" name="contact_number" class="form-control" placeholder="Puede ser fijo o móvil">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Agregar</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
</form>
<?php include '../../includes/footer.php'; ?>