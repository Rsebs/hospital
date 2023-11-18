<footer class="mt-5 py-5 bg-color-light footer">
	<div class="d-md-flex justify-content-evenly align-items-start text-center mb-5">
		<nav class="d-flex flex-column gap-2 mb-4">
			<a class="text-decoration-none text-black" href="<?= $urlAboutUs ?>">Sobre Nosotros</a>
			<a class="text-decoration-none text-black" href="<?= $urlContact ?>">Contacto</a>
		</nav>
		<?php if (!empty($_SESSION['id'])) { ?>
			<nav class="d-flex flex-column gap-2 mb-4">
				<a class="text-decoration-none text-black" href="<?= $urlPersonal ?>">Personal</a>
				<a class="text-decoration-none text-black" href="<?= $urlPatient ?>">Pacientes</a>
				<a class="text-decoration-none text-black" href="<?= $urlMedicine ?>">Medicina</a>
				<a class="text-decoration-none text-black" href="<?= $urlGender ?>">Géneros</a>
				<a class="text-decoration-none text-black" href="<?= $urlUsers ?>">Usuarios</a>
			</nav>
		<?php } ?>
		<div class="d-flex justify-content-center align-items-center">
			<img class="img-fluid logo" src="<?= $imgHospitalApp ?>" alt="image logo" width="100px">
		</div>
	</div>
	<p class="text-center text-uppercase text-decoration-underline link-offset-3 fw-italic m-0">Todos los derechos reservados <?= date('Y') ?> &copy;</p>
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="<?= $urlBootstrapJS ?>"></script>
<!-- My JS -->
<script src="<?= $urlJS ?>"></script>
</body>

</html>