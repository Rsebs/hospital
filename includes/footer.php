<?php
include 'urls.php';
?>
<footer class="mt-5 py-5 bg-color-light footer">
	<div class="d-md-flex justify-content-evenly align-items-start text-center mb-5">
		<nav class="d-flex flex-column gap-2 mb-4">
			<a class="text-decoration-none text-black" href="<?php echo $urlAboutUs; ?>">Sobre Nosotros</a>
			<a class="text-decoration-none text-black" href="<?php echo $urlContact; ?>">Contacto</a>
		</nav>
		<?php if (!empty($_SESSION['user_id'])) { ?>
			<nav class="d-flex flex-column gap-2 mb-4">
				<a class="text-decoration-none text-black" href="<?php echo $urlPersonal; ?>">Personal</a>
				<a class="text-decoration-none text-black" href="<?php echo $urlPatient; ?>">Pacientes</a>
				<a class="text-decoration-none text-black" href="<?php echo $urlMedicine; ?>">Medicina</a>
				<a class="text-decoration-none text-black" href="<?php echo $urlGender; ?>">Géneros</a>
				<a class="text-decoration-none text-black" href="<?php echo $urlUsers; ?>">Usuarios</a>
			</nav>
		<?php } ?>
		<div class="d-flex justify-content-center align-items-center">
			<img class="img-fluid logo" src="<?php echo $imgHospitalApp; ?>" alt="image logo" width="100px">
		</div>
	</div>
	<p class="text-center text-uppercase text-decoration-underline link-offset-3 fw-italic m-0">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="<?php echo $urlServer; ?>/public/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- My JS -->
<script src="<?php echo $urlServer; ?>/public/js/app.js"></script>
</body>

</html>