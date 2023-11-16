<?php
include 'urls.php';
$siteName = 'HospitalDev';

session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title><?= $siteName ?> | <?= $page ?></title>
	<link rel="icon" href="<?= $imgHospitalApp ?>" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bitter:wght@400;600&family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
	<!-- Bootstrap CSS v5.3.2 -->
	<link rel="stylesheet" href="<?= $urlBootstrapCSS ?>" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= $urlCSS ?>">
</head>

<body>
	<header class="mb-5 header">
		<nav class="navbar navbar-expand-sm bg-color-light">
			<div class="container">
				<img class="logo" src="<?= $imgHospitalApp ?>" alt="image hospital app">
				<a class="navbar-brand title" href="<?= $urlIndex ?>">Hospital<span>Dev</span></a>
				<?php if (!empty($_SESSION['id'])) { ?>
					<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				<?php } ?>
				<div class="collapse navbar-collapse" id="collapsibleNavId">
					<?php if (!empty($_SESSION['id'])) { ?>
						<ul class="navbar-nav me-auto mt-2 mt-lg-0">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrar</a>
								<div class="dropdown-menu" aria-labelledby="dropdownId">
									<a class="dropdown-item" href="<?= $urlBill ?>">Facturas</a>
									<a class="dropdown-item" href="<?= $urlPersonal ?>">Personal</a>
									<a class="dropdown-item" href="<?= $urlPatient ?>">Pacientes</a>
									<a class="dropdown-item" href="<?= $urlMedicine ?>">Medicamentos</a>
									<a class="dropdown-item" href="<?= $urlGender ?>">Géneros</a>
									<a class="dropdown-item" href="<?= $urlUsers ?>">Usuarios</a>
								</div>
							</li>
							<li class="nav-item">
								<p class="nav-link m-0 fw-bold">Bievenido <?= $_SESSION['user_name'] ?></p>
							</li>
						</ul>
					<?php } ?>
				</div>
				<nav class="navbar-nav me-auto mt-2 mt-lg-0">
					<?php if (!empty($_SESSION['id'])) { ?>
						<a class="nav-link" href="<?= $urlLogOut ?>">Cerrar Sesión</a>
					<?php } else { ?>
						<a class="nav-link" href="<?= $urlLogin ?>">Iniciar Sesión</a>
						<a class="nav-link" href="<?= $urlSignUp ?>">Regístrate</a>
					<?php } ?>
				</nav>
			</div>
		</nav>
	</header>