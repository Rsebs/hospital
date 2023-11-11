<?php
function validateSession()
{
	include 'urls.php';
	if (empty($_SESSION['user_id'])) {
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => redirect('$urlServer/session/login.php', 0));
		</script>
		";
	}
}
