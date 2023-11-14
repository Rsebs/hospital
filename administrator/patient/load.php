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
					<a href="edit.php?id=' . $r['id'] . '" title="Editar Factura" class="btn btn-success">
						<img src="' . $imgEdit . '" alt="image edit">
					</a>
					<form action="destroy.php" method="POST" data-type-form="delete">
						<input type="hidden" name="id" value="' . $r['id'] . '">
						<button type="submit" title="Borrar Factura" class="btn btn-danger">
							<img src="' . $imgRemove . '" alt="image remove">
						</button>
					</form>
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
