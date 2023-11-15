<?php
$page = 'Pacientes';
include '../../includes/head.php';

include '../../includes/functions.php';
validateSession();
?>
<input type="hidden" value="patient" id="controller">
<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="m-0">Pacientes</p>
		</div>
		<div class="card-body">
			<a href="create.php" class="btn btn-primary mb-3">
				<img src="<?= $imgUserAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Paciente</p>
			</a>
			<?php
			include '../../includes/components/alerts.php';
			?>
			<div class="d-flex gap-4">
				<input type="text" class="form-control w-50" id="filter" name="filter" placeholder="Buscar">
				<div class="spinner-border" role="status" id="spinner">
					<span class="visually-hidden">Loading...</span>
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