<?php
$page = 'Usuarios';
include '../../includes/head.php';
?>

<?php
include '../../includes/functions.php';
validateSession();

include '../../includes/urls.php';
require '../../config/db.php';

// DELETE 
if ($_POST) {
	$user_id = $_POST['user_id'];

	try {
		$query = 'DELETE FROM users WHERE user_id = :user_id';

		$request = $connection->prepare($query);
		$request->bindParam(':user_id', $user_id);
		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Usuario eliminado correctamente.'));
		</script>
		";
		if ($user_id == $_SESSION['user_id']) {
			echo "
    		<script>
    			document.addEventListener('DOMContentLoaded', () => {
    			    showAlert('#alert', ' Cerrando Sesión...', 'error');
    			    redirect('https://hospitaldev.000webhostapp.com/session/login.php', 3000);
    			});
    		
    		</script>
    		";
			session_destroy();
		}
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'No se pudo eliminar el registro, contacta para más información', 'error'));
		</script>
		";
	}
}

try {
	$query = 'SELECT * FROM users';

	$request = $connection->prepare($query);
	$request->execute();

	$resultUser = $connection->query($query);
} catch (Exception $error) {
	echo $error;
}

?>

<main class="container">
	<div class="card">
		<div class="card-header bg-color-primary">
			<p class="m-0">Usuarios</p>
		</div>
		<div class="card-body">
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered mt-3">
					<thead class="table-light">
						<tr>
							<th>Id</th>
							<th>Username</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($resultUser->rowCount() > 0) {
							foreach ($resultUser as $e) {
								echo '
									<tr>
										<td>' . $e['user_id'] . '</td>
										<td>' . $e['user_userName'] . '</td>
										<td class="d-flex flex-sm-column flex-lg-row gap-2">
											<form action="index.php" method="POST" data-type-form="delete">
												<input type="hidden" name="user_id" value="' . $e['user_id'] . '">
												<button type="submit" title="Borrar Género" class="btn btn-danger">
													<img src="' . $imgRemove . '" alt="image remove">
												</button>
											</form>
										</td>
									</tr>
								';
							}
						} else {
							echo '
								<tr>
									<td class="text-center" colspan="3">Aún no hay datos</td>
								</tr>
							';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>

<?php include '../../includes/footer.php'; ?>