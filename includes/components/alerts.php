<?php
if (isset($_SESSION['msg'])) {
	echo
	'
	<div class="alert alert-' . $_SESSION['type'] . ' alert-dismissible fade show" role="alert">
		' . $_SESSION['msg'] . '
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	';
	unset($_SESSION['msg']);
	unset($_SESSION['type']);
}
