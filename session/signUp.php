<?php
$page = 'Regístrate';
include '../includes/head.php';
?>

<?php
include '../config/db.php';
include '../includes/urls.php';

if ($_POST) {
	$user_name = $_POST['user_name'];
	$user_pass = $_POST['user_pass'];

	// Hash a la contraseña
	$user_hash_pass = password_hash($user_pass, PASSWORD_BCRYPT);

	try {
		$query = 'INSERT INTO users(user_name, user_pass) VALUES(:user_name, :user_hash_pass)';

		$request = $connection->prepare($query);
		$request->bindParam(':user_name', $user_name);
		$request->bindParam(':user_hash_pass', $user_hash_pass);
		$request->execute();

		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Te has registrado correctamente'));
		</script>
		";
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => redirect('$urlServer/session/login.php', 4000));
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'El usuario \"$user_name\" ya existe', 'error'));
		</script>
		";
	}
}
?>

<main class="container">
	<form action="signUp.php" method="POST" class="form-center" data-type-form="session">
		<h1 class="text-center mb-4">Regístrate</h1>
		<div class="col-md input-group mb-4">
			<label class="input-group-text" for="user_name">Username</label>
			<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Tu nombre de usuario" required>
		</div>
		<div class="row">
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_pass">Contraseña</label>
				<input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Tu contraseña" required>
				<button data-type-btn="show-password" type="button" class="btn btn-secondary">
					<img src="<?php echo $imgEye; ?>" alt="image eye" title="Mostrar Contraseña">
				</button>
			</div>
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_passVerify">Verificar Contraseña</label>
				<input type="password" class="form-control" id="user_passVerify" placeholder="Verifica tu contraseña" required>
				<button data-type-btn="show-password" type="button" class="btn btn-secondary">
					<img src="<?php echo $imgEye; ?>" alt="image eye" title="Mostrar Contraseña">
				</button>
			</div>
		</div>
		<button type="submit" class="btn btn-success d-block w-25 mx-auto mb-4">Registrarse</button>
		<p class="text-center">¿Ya tienes una cuenta? <a href="login.php" class="text-decoration-none">Inicia Sesión</a></p>
		<div id="alert" class="text-center"></div>
	</form>
</main>

<?php include '../includes/footer.php'; ?>