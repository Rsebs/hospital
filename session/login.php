<?php
$page = 'Iniciar Sesión';
include '../includes/head.php';
?>

<?php
include '../config/db.php';
include '../includes/urls.php';

if ($_POST) {
	$user_userName = $_POST['user_userName'];
	$user_password = $_POST['user_password'];

	try {
		$query = 'SELECT * FROM users WHERE user_userName = :user_userName';

		$request = $connection->prepare($query);
		$request->bindParam(':user_userName', $user_userName);
		$request->execute();

		$resultUser = $request->fetch(PDO::FETCH_LAZY);

		if ($resultUser) {
			if (password_verify($user_password, $resultUser['user_password'])) {
				$_SESSION['user_id'] = $resultUser['user_id'];
				$_SESSION['user_userName'] = $resultUser['user_userName'];
				header('location:/hospital/');
			} else {
				echo "
				<script>
					document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Contraseña incorrecta', 'error'));
				</script>
			";
			}
		} else {
			echo "
			<script>
				document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'El usuario no existe', 'error'));
			</script>
			";
		}
	} catch (Exception $error) {
		echo $error;
	}
}
?>

<main class="container">
	<form action="login.php" method="POST" class="form-center" data-type-form="session">
		<h1 class="text-center mb-4">Inicia Sesión</h1>
		<div class="row">
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_userName">Username</label>
				<input type="text" class="form-control" id="user_userName" name="user_userName" placeholder="Tu nombre de usuario" required>
			</div>
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_password">Contraseña</label>
				<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Tu contraseña" required>
				<button id="btnShowPassword" type="button" class="btn btn-secondary" data-type-btn="show-password">
					<img src="<?php echo $imgEye; ?>" alt="image eye" title="Mostrar Contraseña">
				</button>
			</div>
		</div>
		<button type="submit" class="btn btn-success d-block w-25 mx-auto mb-4">Iniciar Sesión</button>
		<p class="text-center">¿Aún no tienes una cuenta? <a href="signUp.php" class="text-decoration-none">Regístrate</a></p>
		<div id="alert" class="text-center"></div>
	</form>
</main>

<?php include '../includes/footer.php'; ?>