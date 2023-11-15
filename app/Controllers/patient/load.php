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
	'g.name'
];
$columnsWhere = [
	'document',
	'first_name',
	'second_name',
	'first_last_name',
	'second_last_name',
	'email',
	'contact_number',
	'g.name'
];

$filter = isset($_POST['filter']) ? $_POST['filter'] : null;

$where = '';
if ($filter !== null) {
	$where = 'WHERE (';

	for ($i = 0; $i < count($columnsWhere); $i++) {
		$where .= $columnsWhere[$i] . " LIKE '%$filter%' OR ";
	}

	$where = substr_replace($where, '', -3);
	$where .= ')';
}

// Consulta principal, get patients. HTML
$sql = "SELECT " . implode(",", $columns) . " FROM $table p INNER JOIN genders g ON p.gender_id = g.id $where ORDER BY id DESC";
$result = $connection->query($sql);

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

$html = '';
if ($result->rowCount() > 0) {
	foreach ($result as $r) {
		$html .= '
		<tr>
			<td>' . $r['document'] . '</td>
			<td>' . $r['first_name'] . ' ' . $r['second_name'] . ' ' . $r['first_last_name'] . ' ' . $r['second_last_name'] . '
			</td>
			<td>' . $r['name'] . '</td>
			<td>' . $r['email'] . '</td>
			<td>' . $r['contact_number'] . '</td>
			<td class="d-flex flex-sm-column flex-lg-row gap-2">
				<div>
					<button type="button" class="btn btn-secondary" title="Crear Factura" data-bs-toggle="modal" data-bs-target="#modal-create-bill-' . $r['id'] . '">
						<img src="' . $imgBillAdd . '" alt="image remove">
					</button>
					<form action="' . $patientController . '/createBill.php" method="POST">
						<div class="modal fade" id="modal-create-bill-' . $r['id'] . '" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-lg modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5">Crear Factura de Paciente</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="id" id="id" value="' . $r['id'] . '">
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
													<label class="input-group-text" for="doc_id">Doctor Responsable</label>
													<select class="form-select" name="doc_id" id="doc_id" required>
														<option value="" selected disabled>-- Selecciona --</option>
														' . $optionPersonal . '
													</select>
												</div>
												<div class="row">
													<div class="input-group mb-4 col-lg">
														<label class="input-group-text" for="medicine_id">Medicina Recetada</label>
														<select class="form-select" name="medicine_id" id="medicine_id" required>
															<option value="" selected disabled>-- Selecciona --</option>
															' . $optionMedicine . '
														</select>
													</div>
													<div class="input-group mb-4 col-lg">
														<label for="amount" class="input-group-text">Cantidad</label>
														<input type="contact_number" name="amount" id="amount" class="form-control" placeholder="Cantidad Recetada" min="1" required>
													</div>
												</div>
												<div class="form-floating">
													<textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 150px" required></textarea>
													<label for="description">Descripción de la Receta</label>
												</div>
											</fieldset>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">Guardar Cambios</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div> <!-- Create Bill -->
				<div>
					<button type="button" class="btn btn-success" title="Editar" data-bs-toggle="modal" data-bs-target="#modal-edit-' . $r['id'] . '">
						<img src="' . $imgEdit . '" alt="image remove">
					</button>
					<form action="' . $patientController . '/update.php" method="POST">
						<div class="modal fade" id="modal-edit-' . $r['id'] . '" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5">Editar Registro</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="id" id="id" value="' . $r['id'] . '">
										<div class="mt-4">
											<div class="row">
												<div class="input-group mb-4 col-lg">
													<label for="first_name" class="input-group-text">Nombres</label>
													<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Primero" value="' . $r['first_name'] . '" required>
													<input type="text" name="second_name" id="second_name" class="form-control" placeholder="Segundo" value="' . $r['second_name'] . '">
												</div>
												<div class="input-group mb-4 col-lg">
													<label for="first_last_name" class="input-group-text">Apellidos</label>
													<input type="text" name="first_last_name" id="first_last_name" class="form-control" placeholder="Primero" value="' . $r['first_last_name'] . '" required>
													<input type="text" name="second_last_name" id="second_last_name" class="form-control" placeholder="Segundo" value="' . $r['second_last_name'] . '">
												</div>
											</div>
											<div class="row">
												<div class="input-group mb-4 col-lg">
													<label for="document" class="input-group-text">Documento</label>
													<input type="text" name="document" id="document" class="form-control" placeholder="Número de Documento" required value="' . $r['document'] . '">
												</div>
												<div class="input-group mb-4 col-lg">
													<label class="input-group-text" for="gender">Género</label>
													<select class="form-select" name="gender_id" id="gender" required>
														<option value="" selected disabled>-- Selecciona --</option>
														' . $optionGender . '
													</select>
												</div>
											</div>
											<div class="row">
												<div class="input-group mb-4 col-lg">
													<label for="email" class="input-group-text">Email</label>
													<input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" value="' . $r['email'] . '">
												</div>
												<div class="input-group mb-4 col-lg">
													<label for="contact_number" class="input-group-text">Número de Teléfono</label>
													<input type="tel" name="contact_number" id="contact_number" class="form-control" placeholder="Puede ser fijo o móvil" value="' . $r['contact_number'] . '">
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">Guardar Cambios</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div> <!-- Edit -->
				<div>
					<button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#modal-delete-' . $r['id'] . '">
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
		</tr>';
	}
} else {
	$html .= '
	<tr>
		<td class="text-center" colspan="6">No hay resultados</td>
	</tr>
	';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
