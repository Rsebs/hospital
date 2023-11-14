<?php
function validateSession()
{
	include 'urls.php';
	if (empty($_SESSION['id'])) {
		// echo "
		// <script>
		// 	document.addEventListener('DOMContentLoaded', () => redirect('$urlLogin', 0));
		// </script>
		// ";

		header("location: $urlLogin");
	}
}
