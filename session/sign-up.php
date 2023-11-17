<?php
$page = 'Regístrate';
include '../includes/head.php';
?>

<main class="container">
	<form action="<?= $sessionController ?>/signUp.php" method="POST" class="form-center" data-type-form="session">
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
					<img src="<?= $imgEye ?>" alt="image eye" title="Mostrar Contraseña">
				</button>
			</div>
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_passVerify">Verificar Contraseña</label>
				<input type="password" class="form-control" id="user_passVerify" placeholder="Verifica tu contraseña" required>
				<button data-type-btn="show-password" type="button" class="btn btn-secondary">
					<img src="<?= $imgEye ?>" alt="image eye" title="Mostrar Contraseña">
				</button>
			</div>
		</div>
		<button type="submit" class="btn btn-success d-block w-25 mx-auto mb-4">Registrarse</button>
		<p class="text-center">¿Ya tienes una cuenta? <a href="login.php" class="text-decoration-none">Inicia Sesión</a></p>
		<?php
		include '../includes/components/alerts.php';
		?>
		<div id="alert"></div>
	</form>
</main>

<?php include '../includes/footer.php'; ?>