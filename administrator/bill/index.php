<?php
$page = 'Inicio';
include '../../includes/head.php';

include '../../includes/functions.php';
validateSession();
?>

<input type="hidden" value="bill" id="controller">
<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="my-1 text-center fs-5">Facturas</p>
		</div>
		<div class="card-body">
			<a href="<?= $urlPatient; ?>" class="btn btn-primary mb-3">
				<img src="<?= $imgBillAdd ?>" alt="image add">
				<p class="d-inline-block mx-2 my-0">Crear una Factura</p>
			</a>
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
							<th>ID Factura</th>
							<th>Paciente</th>
							<th>Doctor Responsable</th>
							<th>Ordenado</th>
							<th>Fecha remitido</th>
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
<?php include '../../includes/footer.php'; ?>