<?php
$page = 'Iniciar Sesión';
include '../includes/head.php';
?>

<?php
include '../config/db.php';
include '../includes/urls.php';

if ($_POST) {
	$user_name = $_POST['user_name'];
	$user_pass = $_POST['user_pass'];

	try {
		$query = 'SELECT * FROM users WHERE user_name = :user_name';

		$request = $connection->prepare($query);
		$request->bindParam(':user_name', $user_name);
		$request->execute();

		$resultUser = $request->fetch(PDO::FETCH_LAZY);

		if ($resultUser) {
			if (password_verify($user_pass, $resultUser['user_pass'])) {
				$_SESSION['id'] = $resultUser['id'];
				$_SESSION['user_name'] = $resultUser['user_name'];
				header("location:$urlIndex");
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
				<label class="input-group-text" for="user_name">Username</label>
				<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Tu nombre de usuario" required>
			</div>
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_pass">Contraseña</label>
				<input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Tu contraseña" required>
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