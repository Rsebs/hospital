<?php
$page = 'Iniciar Sesión';
include '../includes/head.php';
?>

<main class="container">
	<form action="<?= $sessionController ?>/login.php" method="POST" class="form-center">
		<h1 class="text-center mb-4">Inicia Sesión</h1>
		<div class="row">
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_name">Username</label>
				<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Tu nombre de usuario" required>
			</div>
			<div class="col-lg input-group mb-4">
				<label class="input-group-text" for="user_pass">Contraseña</label>
				<input type="password" class="form-control" name="user_pass" placeholder="Tu contraseña" required>
				<button id="btnShowPassword" type="button" class="btn btn-secondary" data-type-btn="show-password">
					<img src="<?= $imgEye; ?>" alt="image eye" title="Mostrar Contraseña">
				</button>
			</div>
		</div>
		<button type="submit" class="btn btn-success d-block w-25 mx-auto mb-4">Iniciar Sesión</button>
		<p class="text-center">¿Aún no tienes una cuenta? <a href="<?= $urlSignUp ?>" class="text-decoration-none">Regístrate</a></p>
		<?php
		include '../includes/components/alerts.php';
		?>
	</form>
</main>

<?php include '../includes/footer.php'; ?>