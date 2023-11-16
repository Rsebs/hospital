<?php
require '../../../config/db.php';
include '../../../includes/urls.php';
session_start();

$table = 'bills b';
$columns = [
	'b.id AS bill_id',
	'pat.document AS pat_document',
	'pat.first_name AS pat_first_name',
	'pat.second_name AS pat_second_name',
	'pat.first_last_name AS pat_first_last_name',
	'pat.second_last_name AS pat_second_last_name',
	'pat.email AS pat_email',
	'pat.contact_number AS pat_contact_number',
	'per.document AS per_document',
	'per.first_name AS per_first_name',
	'per.second_name AS per_second_name',
	'per.first_last_name AS per_first_last_name',
	'per.second_last_name AS per_second_last_name',
	'per.email AS per_email',
	'per.contact_number AS per_contact_number',
	'm.name AS medicine_name',
	'b.amount AS bill_amount',
	'b.description AS bill_description',
	'b.create_date AS bill_create_date'
];
$columnsWhere = [
	'pat.document',
	'pat.first_name',
	'pat.second_name',
	'pat.first_last_name',
	'pat.second_last_name',
	'per.document',
	'per.first_name',
	'per.second_name',
	'per.first_last_name',
	'per.second_last_name',
	'm.name',
	'b.create_date'
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
$sql = 
"SELECT SQL_CALC_FOUND_ROWS " . implode(",", $columns) . " 
FROM $table 
INNER JOIN 
		patients pat ON pat.id = b.pat_id
	INNER JOIN 
		personals per ON per.id = b.per_id
	INNER JOIN 
		medicines m ON m.id = b.medicine_id
$where 
ORDER BY b.create_date DESC 
$sLimit";
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
			<td>' . $r['bill_id'] . '</td>
			<td> (' . $r['pat_document'] . ') ' . $r['pat_first_name'] . ' ' . $r['pat_second_name'] . ' ' .
				$r['pat_first_last_name'] . ' ' . $r['pat_second_last_name'] . '</td>
			<td> (' . $r['per_document'] . ') ' . $r['per_first_name'] . ' ' . $r['per_second_name'] . ' ' .
				$r['per_first_last_name'] . ' ' . $r['per_second_last_name'] . '</td>
			<td>' . $r['medicine_name'] . ' (' . $r['bill_amount'] . ')</td>
			<td>' . $r['bill_create_date'] . '</td>
			<td class="d-flex flex-sm-column flex-lg-row gap-2">
				<div>
					<button type="button" class="btn btn-primary" title="Resumen" data-bs-toggle="modal"
						data-bs-target="#modal-show-' . $r['bill_id'] . '">
						<img src="' . $imgEye . '" alt="image remove">
					</button>
					<div class="modal fade" id="modal-show-' . $r['bill_id'] . '" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5">Resumen</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="seeBill">
										<fieldset class="mb-4 px-4 py-2">
											<legend class="mb-4">
												<h2 class="fs-4 my-2 py-2">Información del Paciente</h2>
											</legend>
											<div class="row align-items-center">
												<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
												<p class="mb-4 col-8 col-lg"> '. $r['pat_first_name'] . ' ' . $r['pat_second_name'] . ' ' . $r['pat_first_last_name'] . ' ' . $r['pat_second_last_name'] . '</p>
												<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
												<p class="mb-4 col-8 col-lg">'. $r['pat_document'] . '</p>
											</div>
											<div class="row align-items-center">
												<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
												<p class="mb-4 col-8 col-lg">'. $r['pat_email']. '</p>
												<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
												<p class="mb-4 col-8 col-lg">'. $r['pat_contact_number'] .'</p>
											</div>
										</fieldset>
										<fieldset class="mb-4 px-4 py-2">
											<legend class="mb-4">
												<h2 class="fs-4 my-2 py-2">Información del Doctor Responsable</h2>
											</legend>
											<div class="row align-items-center">
												<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
												<p class="mb-4 col-8 col-lg"> '. $r['per_first_name'] . ' ' . $r['per_second_name'] . ' ' . $r['per_first_last_name'] . ' ' . $r['per_second_last_name'] .'</p>
												<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
												<p class="mb-4 col-8 col-lg">'. $r['per_document'] .'</p>
											</div>
											<div class="row align-items-center">
												<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
												<p class="mb-4 col-8 col-lg">'. $r['per_email'] .'</p>
												<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
												<p class="mb-4 col-8 col-lg">'. $r['per_contact_number'] .'</p>
											</div>
										</fieldset>
										<fieldset class="mb-4 px-4 pt-2 pb-4">
											<legend class="mb-4">
												<h2 class="fs-4 my-2 py-2">Información de la Factura</h2>
											</legend>
											<div class="row align-items-center">
												<p class="mb-4 col-4 col-lg-2 fw-bold">Medicina Recetada:</p>
												<p class="mb-4 col-8 col-lg">'. $r['medicine_name'] .'</p>
												<p class="mb-4 col-4 col-lg-2 fw-bold">Cantidad:</p>
												<p class="mb-4 col-8 col-lg">'. $r['bill_amount'] .'</p>
											</div>
											<p class="mb-4"><strong>Fecha remitido: </strong>'. $r['bill_create_date'] .'</p>
											<div class="form-floating">
												<textarea class="form-control" placeholder="Leave a comment here" id="bill_description" name="bill_description" style="height: 200px" readonly>'. $r['bill_description'] .'</textarea>
												<label for="bill_description">Descripción de la Receta</label>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Show -->
				<div>
					<button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal"
						data-bs-target="#modal-delete-' . $r['bill_id'] . '">
						<img src="' . $imgRemove . '" alt="image remove">
					</button>
					<div class="modal fade" id="modal-delete-' . $r['bill_id'] . '" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5 text-danger fw-bold">Eliminar Registro</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<p>¿Estás seguro que quieres eliminar el siguiente registro?</p>
									<p><strong>Id de la factura: </strong>' . $r['bill_id'] . '</p>
								</div>
								<div class="modal-footer">
									<form action="' . $billController . '/destroy.php" method="POST" data-type-form="delete">
										<input type="hidden" name="bill_id" value="' . $r['bill_id'] . '">
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
