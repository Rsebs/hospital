<?php
require '../../../config/db.php';
include '../../../includes/urls.php';
session_start();

$table = 'medicines';
$columns = [
	'id',
	'name',
	'description',
	'create_date',
	'edit_date'
];
$columnsWhere = [
	'id',
	'name',
	'description',
	'create_date'
];

$filter = isset($_POST['filter']) ? $_POST['filter'] : null;

// Where
$where = '';
if ($filter !== null) {
	$where = 'WHERE (';

	for ($i = 0; $i < count($columnsWhere); $i++) {
		$where .= $columnsWhere[$i] . " LIKE '%$filter%' OR ";
	}

	$where = substr_replace($where, '', -3);
	$where .= ')';
}

// Limit
$limit = isset($_POST['registers']) ? $_POST['registers'] : 10;
$page = isset($_POST['page']) ? $_POST['page'] : 0;

if (!$page) {
	$start = 0;
	$page = 1;
} else {
	$start = ($page - 1) * $limit;
}

$sLimit = "LIMIT $start, $limit";

// Consulta principal, get. HTML
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(",", $columns) . " FROM $table $where ORDER BY create_date DESC $sLimit";
$result = $connection->query($sql);

// Consulta para total de registros filtrados
$sqlFilter = "SELECT FOUND_ROWS()";
$resultFilter = $connection->query($sqlFilter);
$row_filter = $resultFilter->fetch(PDO::FETCH_ASSOC);
$total_filter = $row_filter['FOUND_ROWS()'];

// Consulta para total de registros filtrados
$sqlTotal = "SELECT count('id') AS count FROM $table ";
$resultTotal = $connection->query($sqlTotal);
$row_total = $resultTotal->fetch(PDO::FETCH_ASSOC);
$total_registers = $row_total['count'];

$output = [];
$output['total_registers'] = $total_registers;
$output['total_filter'] = $total_filter;
$output['data'] = '';
$output['pagination'] = '';

if ($result->rowCount() > 0) {
	foreach ($result as $r) {
		$output['data'] .= '
		<tr>
			<td>' . $r['id'] . '</td>
			<td>' . $r['name'] . '</td>
			<td>' . $r['description'] . '</td>
			<td>' . $r['create_date'] . '</td>
			<td class="d-flex flex-sm-column flex-lg-row gap-2">
				<div>
					<button type="button" class="btn btn-primary" title="Resumen" data-bs-toggle="modal"
						data-bs-target="#modal-show-' . $r['id'] . '">
						<img src="' . $imgEye . '" alt="image remove">
					</button>
					<div class="modal fade" id="modal-show-' . $r['id'] . '" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5">Resumen</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<fieldset>
										<legend class="text-secondary mb-4">Información de ' . $r['name'] . '</legend>
										<p class="mb-4"><strong>Nombre de medicamento: </strong>' . $r['name'] . '</p>
										<div class="form-floating mb-4">
											<textarea class="form-control" placeholder="" style="height: 150px" readonly>' . $r['description'] . '</textarea>
											<label>Descripción:</label>
										</div>
										<div class="row align-items-center">
											<p class="mb-4 col-4 col-lg-2 fw-bold">Fecha de ingreso:</p>
											<p class="mb-4 col-8 col-lg">' . $r['create_date'] . '</p>
											<p class="mb-4 col-4 col-lg-2 fw-bold">Último movimiento:</p>
											<p class="mb-4 col-8 col-lg">' . $r['edit_date'] . '</p>
										</div>
									</fieldset>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Show -->
				<div>
					<button type="button" class="btn btn-success" title="Editar" data-bs-toggle="modal"
						data-bs-target="#modal-edit-' . $r['id'] . '">
						<img src="' . $imgEdit . '" alt="image remove">
					</button>
					<form action="' . $medicineController . '/update.php" method="POST">
						<div class="modal fade" id="modal-edit-' . $r['id'] . '" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5">Editar Registro</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="id" value="' . $r['id'] . '">
										<div class="mt-4">
											<div class="input-group mb-4">
												<label for="name" class="input-group-text">Nombre</label>
												<input type="text" name="name" id="name" class="form-control" placeholder="Ej: Naproxeno" value="' . $r['name'] . '" required>
											</div>
											<div class="form-floating">
												<textarea class="form-control" placeholder="" name="description" style="height: 150px" required>' . $r['description'] . '</textarea>
												<label>Descripción</label>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">Guardar Cambios</button>
										<button type="button" class="btn btn-secondary"
											data-bs-dismiss="modal">Cancelar</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div> <!-- Edit -->
				<div>
					<button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal"
						data-bs-target="#modal-delete-' . $r['id'] . '">
						<img src="' . $imgRemove . '" alt="image remove">
					</button>
					<div class="modal fade" id="modal-delete-' . $r['id'] . '" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5 text-danger fw-bold">Eliminar Registro</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<p>¿Estás seguro que quieres eliminar el siguiente registro?</p>
									<p><strong>Nombre: </strong>' . $r['name'] . '</p>
									<p><strong>Ingreso: </strong>' . $r['create_date'] . '</p>
									<p><strong>Último movimiento: </strong>' . $r['edit_date'] . '</p>
								</div>
								<div class="modal-footer">
									<form action="' . $medicineController . '/destroy.php" method="POST" data-type-form="delete">
										<input type="hidden" name="id" value="' . $r['id'] . '">
										<button type="submit" class="btn btn-danger">Eliminar</button>
									</form>
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Delete -->
			</td>
		</tr>
		';
	}
} else {
	$output['data'] .= '
	<tr>
		<td class="text-center" colspan="6">No hay resultados</td>
	</tr>
	';
}

if ($output['total_registers'] > 0) {
	$total_pages = ceil($output['total_registers'] / $limit);
	$output['pagination'] .= '<nav>';
	$output['pagination'] .= '<ul class="pagination justify-content-end">';

	$first_number = 1;

	if (($page - 4) > 1) {
		$first_number = $page - 4;
	}

	$last_number = $first_number + 9;
	if ($last_number > $total_pages) {
		$last_number = $total_pages;
	}

	for ($i = $first_number; $i <= $last_number; $i++) {
		if ($page == $i) {
			$output['pagination'] .= '<li class="page-item active"><button class="page-link">' . $i . '</button></li>';
		} else {
			$output['pagination'] .= '<li class="page-item"><button class="page-link" onclick="getData(' . $i . ')">' . $i . '</button></li>';
		}
	}

	$output['pagination'] .= '</ul>';
	$output['pagination'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
