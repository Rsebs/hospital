<?php
$page = 'Inicio';
include 'includes/head.php';
?>

<?php
include 'includes/functions.php';
validateSession();

require 'config/db.php';
include 'includes/urls.php';

// Total patients
$sql = "SELECT COUNT(*) AS total FROM patients";
$resultPatient = $connection->query($sql);
$row_total = $resultPatient->fetch(PDO::FETCH_ASSOC);
$totalPatient = $row_total['total'];
 
// Total personals
$sql = "SELECT COUNT(*) AS total FROM personals";
$resultPersonal = $connection->query($sql);
$row_total = $resultPersonal->fetch(PDO::FETCH_ASSOC);
$totalPersonal = $row_total['total'];
 
// Total bills
$sql = "SELECT COUNT(*) AS total FROM bills";
$resultBill = $connection->query($sql);
$row_total = $resultBill->fetch(PDO::FETCH_ASSOC);
$totalBill = $row_total['total'];
 
// Total genders
$sql = "SELECT COUNT(*) AS total FROM genders";
$resultGender = $connection->query($sql);
$row_total = $resultGender->fetch(PDO::FETCH_ASSOC);
$totalGender = $row_total['total'];
 
// Total medicines
$sql = "SELECT COUNT(*) AS total FROM medicines";
$resultMedicine = $connection->query($sql);
$row_total = $resultMedicine->fetch(PDO::FETCH_ASSOC);
$totalMedicine = $row_total['total'];
 
// Total users
$sql = "SELECT COUNT(*) AS total FROM users";
$resultUser = $connection->query($sql);
$row_total = $resultUser->fetch(PDO::FETCH_ASSOC);
$totalUser = $row_total['total'];
 
?>
<main class="container">
	<div class="row">
		<div class="col">
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row g-0 align-items-center">
					<div class="col-md-4 text-center">
						<a href="<?= $urlBill ?>">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" width="90" height="90" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4682A9" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2" />
							</svg>
						</a>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">Facturas</h5>
							<p class="card-text">Cantidad de registros: <?= $totalBill ?></p>
							<p class="card-text"><small class="text-body-secondary">Mira los últimos registros</small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row g-0 align-items-center">
					<div class="col-md-4 text-center">
						<a href="<?= $urlPatient ?>">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wheelchair" width="90" height="90" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4682A9" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M8 16m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
								<path d="M19 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
								<path d="M19 17a3 3 0 0 0 -3 -3h-3.4" />
								<path d="M3 3h1a2 2 0 0 1 2 2v6" />
								<path d="M6 8h11" />
								<path d="M15 8v6" />
							</svg>
						</a>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">Pacientes</h5>
							<p class="card-text">Cantidad de registros: <?= $totalPatient ?></p>
							<p class="card-text"><small class="text-body-secondary">Mira los últimos registros</small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row g-0 align-items-center">
					<div class="col-md-4 text-center">
						<a href="<?= $urlPersonal ?>">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stethoscope" width="90" height="90" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4682A9" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M6 4h-1a2 2 0 0 0 -2 2v3.5h0a5.5 5.5 0 0 0 11 0v-3.5a2 2 0 0 0 -2 -2h-1" />
								<path d="M8 15a6 6 0 1 0 12 0v-3" />
								<path d="M11 3v2" />
								<path d="M6 3v2" />
								<path d="M20 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
							</svg>
						</a>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">Personal</h5>
							<p class="card-text">Cantidad de registros: <?= $totalPersonal ?></p>
							<p class="card-text"><small class="text-body-secondary">Mira los últimos registros</small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row g-0 align-items-center">
					<div class="col-md-4 text-center">
						<a href="<?= $urlGender ?>" class="text-decoration-none ">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-man" width="50" height="50" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4682A9" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M10 16v5" />
								<path d="M14 16v5" />
								<path d="M9 9h6l-1 7h-4z" />
								<path d="M5 11c1.333 -1.333 2.667 -2 4 -2" />
								<path d="M19 11c-1.333 -1.333 -2.667 -2 -4 -2" />
								<path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
							</svg>
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-woman" width="50" height="50" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4682A9" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M10 16v5" />
								<path d="M14 16v5" />
								<path d="M8 16h8l-2 -7h-4z" />
								<path d="M5 11c1.667 -1.333 3.333 -2 5 -2" />
								<path d="M19 11c-1.667 -1.333 -3.333 -2 -5 -2" />
								<path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
							</svg>
						</a>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">Géneros</h5>
							<p class="card-text">Cantidad de registros: <?= $totalGender ?></p>
							<p class="card-text"><small class="text-body-secondary">Mira los últimos registros</small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row g-0 align-items-center">
					<div class="col-md-4 text-center">
						<a href="<?= $urlMedicine ?>">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pill" width="90" height="90" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4682A9" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" />
								<path d="M8.5 8.5l7 7" />
							</svg>
						</a>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">Medicamentos</h5>
							<p class="card-text">Cantidad de registros: <?= $totalMedicine ?></p>
							<p class="card-text"><small class="text-body-secondary">Mira los últimos registros</small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row g-0 align-items-center">
					<div class="col-md-4 text-center">
						<a href="<?= $urlUsers ?>">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="90" height="90" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4682A9" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
								<path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
								<path d="M16 3.13a4 4 0 0 1 0 7.75" />
								<path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
							</svg>
						</a>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">Usuarios</h5>
							<p class="card-text">Cantidad de registros: <?= $totalUser ?></p>
							<p class="card-text"><small class="text-body-secondary">Mira los últimos registros</small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php include 'includes/footer.php'; ?>