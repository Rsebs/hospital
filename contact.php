<?php
$page = 'Contacto';
include 'includes/head.php';
?>

<main class="container">
	<?php
	include 'includes/components/alerts.php';
	?>
	<form action="<?= $contactController ?>/email.php" method="POST" class="form-center">
		<h1 class="text-center">Contacto</h1>
		<p class="text-center">Utiliza el siguiente formulario para ponerte en contacto con nosotros</p>
		<div class="row">
			<div class="col-md input-group mb-4">
				<label class="input-group-text" for="contact_name">Nombre</label>
				<input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Tu nombre" required>
			</div>
			<div class="col-md input-group mb-4">
				<label class="input-group-text" for="contact_email">Email</label>
				<input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="Tu email" required>
			</div>
		</div>
		<div class="form-floating mb-4">
			<textarea class="form-control" placeholder="Leave a comment here" id="contact_message" name="contact_message" style="height: 120px" require></textarea>
			<label for="contact_message">Mensaje</label>
		</div>
		<button class="btn btn-success d-block w-25 mx-auto">Enviar</button>
	</form>
</main>

<?php include 'includes/footer.php'; ?>