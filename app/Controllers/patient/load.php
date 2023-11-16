<?php
require '../../../config/db.php';
include '../../../includes/urls.php';

$table = 'patients';
$columns = [
	'p.id',
	'document',
	'first_name',
	'second_name',
	'first_last_name',
	'second_last_name',
	'gender_id',
	'email',
	'contact_number',
	'g.name',
	'p.create_date',
	'p.edit_date'
];
$columnsWhere = [
	'document',
	'first_name',
	'second_name',
	'first_last_name',
	'second_last_name',
	'email',
	'contact_number',
	'g.name',
	'p.create_date'
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
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(",", $columns) . " FROM $table p INNER JOIN genders g ON p.gender_id = g.id $where ORDER BY create_date DESC $sLimit";
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

// get personals. <option></option>
$sql = 'SELECT * FROM personals';
$resultPersonals = $connection->query($sql);
$optionPersonal = '';
foreach ($resultPersonals as $p) {
	$optionPersonal .= '<option value="' . $p['id'] . '">' . $p['first_name'] . ' ' . $p['second_name'] . ' ' . $p['first_last_name'] . ' (' . $p['document'] . ')' . '</option>';
}

// get medicines. <option></option>
$sql = 'SELECT * FROM medicines';
$resultMedicines = $connection->query($sql);
$optionMedicine = '';
foreach ($resultMedicines as $e) {
	$optionMedicine .= '<option value="' . $e['id'] . '">' . $e['name'] . '</option>';
}

// get genders. <option></option>
$sql = 'SELECT * FROM genders';
$resultGenders = $connection->query($sql);
$optionGender = '';
foreach ($resultGenders as $g) {
	$optionGender .= '<option value="' . $g['id'] . '">' . $g['name'] . '</option>';
}

$output = [];
$output['total_registers'] = $total_registers;
$output['total_filter'] = $total_filter;
$output['data'] = '';
$output['pagination'] = '';

if ($result->rowCount() > 0) {
	foreach ($result as $r) {
		$output['data'] .= '
		<tr>
			<td>' . $r['document'] . '</td>
			<td>' . $r['first_name'] . ' ' . $r['second_name'] . ' ' . $r['first_last_name'] . ' ' . $r['second_last_name'] . '</td>
			<td>' . $r['name'] . '</td>
			<td>' . $r['email'] . '</td>
			<td>' . $r['contact_number'] . '</td>
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
										<legend class="text-secondary mb-4">Información de ' . $r['first_name'] . ' ' . $r['first_last_name'] . '</legend>
										<div class="row align-items-center">
											<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
											<p class="mb-4 col-8 col-lg">' . $r['first_name'] . ' ' . $r['second_name'] . ' ' . $r['first_last_name'] . ' ' . $r['second_last_name'] . '</p>
											<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
											<p class="mb-4 col-8 col-lg">' . $r['document'] . '</p>
										</div>
										<div class="row align-items-center">
											<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
											<p class="mb-4 col-8 col-lg">' . $r['email'] . '</p>
											<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
											<p class="mb-4 col-8 col-lg">' . $r['contact_number'] . '</p>
										</div>
										<div class="row align-items-center">
											<p class="mb-4 col-4 col-lg-2 fw-bold">Género:</p>
											<p class="mb-4 col-8 col-lg">' . $r['name'] . '</p>
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
					<button type="button" class="btn btn-secondary" title="Crear Factura" data-bs-toggle="modal"
						data-bs-target="#modal-create-bill-' . $r['id'] . '">
						<img src="' . $imgBillAdd . '" alt="image remove">
					</button>
					<form action="' . $billController . '/create.php" method="POST">
						<div class="modal fade" id="modal-create-bill-' . $r['id'] . '" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-lg modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5">Crear Factura de Paciente</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="pat_id" value="' . $r['id'] . '">
										<div class="mt-4">
											<fieldset>
												<legend class="text-secondary mb-4">Información del Paciente</legend>
												<div class="row align-items-center">
													<p class="mb-4 col-4 col-lg-2 fw-bold">Nombres:</p>
													<p class="mb-4 col-8 col-lg">' . $r['first_name'] . ' ' . $r['second_name'] . ' ' . $r['first_last_name'] . ' ' . $r['second_last_name'] . '</p>
													<p class="mb-4 col-4 col-lg-2 fw-bold">Documento:</p>
													<p class="mb-4 col-8 col-lg">' . $r['document'] . '</p>
												</div>
												<div class="row align-items-center">
													<p class="mb-4 col-4 col-lg-2 fw-bold">Email:</p>
													<p class="mb-4 col-8 col-lg">' . $r['email'] . '</p>
													<p class="mb-4 col-4 col-lg-2 fw-bold">Número de Teléfono:</p>
													<p class="mb-4 col-8 col-lg">' . $r['contact_number'] . '</p>
												</div>
											</fieldset>
											<fieldset>
												<legend class="text-secondary mb-4">Información de la Factura</legend>
												<div class="input-group mb-4 col-lg">
													<label class="input-group-text" for="doc_id_bill__' . $r['id'] . '">Doctor
														Responsable</label>
													<select class="form-select" name="per_id" id="doc_id_bill__' . $r['id'] . '"
														required>
														<option value="" selected disabled>-- Selecciona --</option>
														' . $optionPersonal . '
													</select>
												</div>
												<div class="row">
													<div class="input-group mb-4 col-lg">
														<label class="input-group-text"
															for="medicine_id_bill__' . $r['id'] . '">Medicina Recetada</label>
														<select class="form-select" name="medicine_id"
															id="medicine_id_bill__' . $r['id'] . '" required>
															<option value="" selected disabled>-- Selecciona --</option>
															' . $optionMedicine . '
														</select>
													</div>
													<div class="input-group mb-4 col-lg">
														<label for="amount_bill__' . $r['id'] . '"
															class="input-group-text">Cantidad</label>
														<input type="number" name="amount" id="amount_bill__' . $r['id'] . '"
															class="form-control" placeholder="Cantidad Recetada" min="1"
															required>
													</div>
												</div>
												<div class="form-floating">
													<textarea class="form-control" placeholder=""
														id="description_bill__' . $r['id'] . '" name="description"
														style="height: 150px" required></textarea>
													<label for="description_bill__' . $r['id'] . '">Descripción de la
														Receta</label>
												</div>
											</fieldset>
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
				</div> <!-- Create Bill -->
				<div>
					<button type="button" class="btn btn-success" title="Editar" data-bs-toggle="modal"
						data-bs-target="#modal-edit-' . $r['id'] . '">
						<img src="' . $imgEdit . '" alt="image remove">
					</button>
					<form action="' . $patientController . '/update.php" method="POST">
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
											<div class="row">
												<div class="input-group mb-4 col-lg">
													<label for="first_name_update__' . $r['id'] . '"
														class="input-group-text">Nombres</label>
													<input type="text" name="first_name"
														id="first_name_update__' . $r['id'] . '" class="form-control"
														placeholder="Primero" value="' . $r['first_name'] . '" required>
													<input type="text" name="second_name"
														id="second_name_update__' . $r['id'] . '" class="form-control"
														placeholder="Segundo" value="' . $r['second_name'] . '">
												</div>
												<div class="input-group mb-4 col-lg">
													<label for="first_last_name_update__' . $r['id'] . '"
														class="input-group-text">Apellidos</label>
													<input type="text" name="first_last_name"
														id="first_last_name_update__' . $r['id'] . '" class="form-control"
														placeholder="Primero" value="' . $r['first_last_name'] . '" required>
													<input type="text" name="second_last_name"
														id="second_last_name_update__' . $r['id'] . '" class="form-control"
														placeholder="Segundo" value="' . $r['second_last_name'] . '">
												</div>
											</div>
											<div class="row">
												<div class="input-group mb-4 col-lg">
													<label for="document_update__' . $r['id'] . '"
														class="input-group-text">Documento</label>
													<input type="text" name="document" id="document_update__' . $r['id'] . '"
														class="form-control" placeholder="Número de Documento" required
														value="' . $r['document'] . '">
												</div>
												<div class="input-group mb-4 col-lg">
													<label class="input-group-text"
														for="gender_update__' . $r['id'] . '">Género</label>
													<select class="form-select" name="gender_id"
														id="gender_update__' . $r['id'] . '" required>
														<option value="" selected disabled>-- Selecciona --</option>
														' . $optionGender . '
													</select>
												</div>
											</div>
											<div class="row">
												<div class="input-group mb-4 col-lg">
													<label for="email_update__' . $r['id'] . '"
														class="input-group-text">Email</label>
													<input type="email" name="email" id="email_update__' . $r['id'] . '"
														class="form-control" placeholder="Correo Electrónico"
														value="' . $r['email'] . '">
												</div>
												<div class="input-group mb-4 col-lg">
													<label for="contact_number_update__' . $r['id'] . '"
														class="input-group-text">Número de Teléfono</label>
													<input type="tel" name="contact_number"
														id="contact_number_update__' . $r['id'] . '" class="form-control"
														placeholder="Puede ser fijo o móvil"
														value="' . $r['contact_number'] . '">
												</div>
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
									<p><strong>Documento: </strong>' . $r['document'] . '</p>
									<p><strong>Nombres: </strong>' . $r['first_name'] . ' ' . $r['second_name'] . ' ' . $r['first_last_name'] . ' ' . $r['second_last_name'] . '</p>
									<p><strong>Ingreso: </strong>' . $r['create_date'] . '</p>
									<p><strong>Último movimiento: </strong>' . $r['edit_date'] . '</p>
								</div>
								<div class="modal-footer">
									<form action="' . $patientController . '/destroy.php" method="POST" data-type-form="delete">
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
