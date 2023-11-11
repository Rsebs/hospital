<?php
$page = 'Sobre Nosotros';
include 'includes/head.php';
include 'includes/urls.php';

$siteName = 'HospitalDev';
?>

<main class="container">
	<h1 class="text-center">Sobre Nosotros</h1>
	<div class="row align-items-center">
		<div class="col-lg">
			<img class="rounded mx-auto d-block img-fluid" src="<?php echo $imgAboutUs01; ?>" alt="image about us">
		</div>
		<div class="col-lg">
			<p>Bienvenidos al Hospital <strong><?php echo $siteName; ?>,</strong> un centro de atención médica comprometido con la salud y el bienestar de nuestra comunidad desde [año de fundación]. Nuestra misión es proporcionar atención médica de alta calidad, compasión y apoyo a nuestros pacientes y sus familias en todo momento.</p>
			<p>En <strong><?php echo $siteName; ?>,</strong> estamos dedicados a la excelencia en la atención médica. Nuestro equipo de médicos, enfermeras y personal de apoyo trabaja incansablemente para garantizar que cada paciente reciba el más alto nivel de atención médica, basada en la evidencia científica y en la última tecnología médica.</p>
			<p>Nuestra instalación cuenta con tecnología de vanguardia y un entorno hospitalario de vanguardia para garantizar un ambiente seguro y cómodo para nuestros pacientes. Estamos comprometidos con la mejora continua y la inversión en la última tecnología médica para ofrecer diagnósticos precisos y tratamientos efectivos. </p>
		</div>
	</div>
	<div class="row align-items-center">
		<div class="col-lg">
			<p>En <strong><?php echo $siteName; ?>,</strong> también valoramos la relación de confianza entre médicos y pacientes. Fomentamos la comunicación abierta y la participación activa de los pacientes en sus planes de tratamiento. Nos enorgullece ser un lugar donde los pacientes se sienten escuchados y respetados.</p>
			<p>Nuestro compromiso con la comunidad va más allá de la atención médica. Colaboramos con organizaciones locales para promover la educación en salud, la prevención de enfermedades y el bienestar en general.</p>
			<p>Agradecemos la confianza que depositan en nosotros y esperamos poder servirles en todas sus necesidades de atención médica. En <strong><?php echo $siteName; ?>,</strong> estamos aquí para cuidar de usted y su familia en cada paso de su viaje hacia la salud y la recuperación.</p>
			<p>Si tiene alguna pregunta o necesita más información sobre nuestros servicios, no dude en ponerse en contacto con nosotros. Estamos disponibles las 24 horas del día, los 7 días de la semana, para atender sus necesidades de atención médica.</p>
			<p>Gracias por elegir <strong><?php echo $siteName; ?></strong> como su socio en la atención médica.</p>
		</div>
		<div class="col-lg">
			<img class="rounded mx-auto d-block img-fluid" src="<?php echo $imgAboutUs02; ?>" alt="image about us">
		</div>
	</div>
</main>

<?php include 'includes/footer.php'; ?>