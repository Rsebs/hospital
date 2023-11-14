<?php
require '../../config/db.php';
include '../../includes/urls.php';

$columns = ['p.id', 'document', 'first_name', 'second_name', 'first_last_name', 'second_last_name', 'gender_id', 'email', 'contact_number', 'g.name'];

$table = 'patients';

$filter = isset($_POST['filter']) ? $_POST['filter'] : null;

$where = '';

if ($filter !== null) {
	$where = 'WHERE (';

	$cont = count($columns);
	for ($i = 0; $i < $cont; $i++) {
		$where .= $columns[$i] . " LIKE '%$filter%' OR ";
	}

	$where = substr_replace($where, '', -3);
	$where .= ')';
}

$sql = "SELECT " . implode(", ", $columns) . " FROM $table p INNER JOIN genders g ON p.gender_id = g.id $where ORDER BY id DESC";

$result = $connection->query($sql);

$html = '';

if ($result->rowCount() > 0) {
	foreach ($result as $r) {
		$html .= '
			<tr>
				<td>' . $r['document'] . '</td>
				<td>' . $r['first_name'] . ' ' . $r['second_name'] . ' ' . $r['first_last_name'] . ' ' . $r['second_last_name'] . '</td>
				<td>' . $r['name'] . '</td>
				<td>' . $r['email'] . '</td>
				<td>' . $r['contact_number'] . '</td>
				<td class="d-flex flex-sm-column flex-lg-row gap-2">
					<a href="createBill.php?id=' . $r['id'] . '" title="Crear Factura" class="btn btn-secondary">
						<img src="' . $imgBillAdd . '" alt="image edit">
					</a>
					<a href="edit.php?id=' . $r['id'] . '" title="Editar" class="btn btn-success">
						<img src="' . $imgEdit . '" alt="image edit">
					</a>
					<button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#modal-delete-' . $r['id'] . '">
						<img src="' . $imgRemove . '" alt="image remove">
					</button>
					<div class="modal fade" id="modal-delete-' . $r['id'] . '" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5 text-danger fw-bold" id="exampleModalLabel">Eliminar Registro</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<p>¿Estás seguro que quieres eliminar el siguiente registro?</p>
									<p><strong>Documento: </strong>' . $r['document'] . '</p>
									<p><strong>Nombres: </strong>' . $r['first_name'] . ' ' . $r['second_name'] . ' ' . $r['first_last_name'] . ' ' . $r['second_last_name'] . '</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
									<form action="destroy.php" method="POST" data-type-form="delete">
										<input type="hidden" name="id" value="' . $r['id'] . '">
										<button type="submit" class="btn btn-danger">Eliminar</button>
									</form>
								</div>
							</div>
						</div>
					</div>
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
