<?php
$page = 'Género';
include '../../includes/head.php';

include '../../includes/functions.php';
validateSession();
?>
<input type="hidden" value="gender" id="controller">
<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="my-1 text-center fs-5">Personal</p>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-create">
				<img src="<?= $imgAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Agregar Género</p>
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
							<th>Id</th>
							<th>Nombre</th>
							<th>Código</th>
							<th>Fecha Agregado</th>
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
<form action="<?= $genderController ?>/create.php" method="POST" class="container">
	<div class="modal fade" id="modal-create" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5">Agregar Registro</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mt-4 row">
						<div class="col-md input-group mb-4">
							<label for="name" class="input-group-text">Nombre</label>
							<input type="text" name="name" class="form-control" placeholder="Ej: Masculino" required>
						</div>
						<div class="col-md input-group mb-4">
							<label for="cod" class="input-group-text">Código</label>
							<input type="text" name="cod" class="form-control" placeholder="Ej: M" required>
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