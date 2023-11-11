// Válida si se desea eliminar un registro
const formsDelete = document.querySelectorAll('[data-type-form="delete"]');
if (formsDelete) {
	formsDelete.forEach(form => {
		form.addEventListener('submit', e => {
			e.preventDefault();
			if (confirm('¿Deseas eliminar?')) {
				form.submit();
				return;
			}
		});
	});
}

// Muestra una alerta al usuario
function showAlert(ref, msg, type) {
	const divAlert = document.createElement('div');
	divAlert.classList.add('alert', 'my-3');

	if (type === 'error') {
		divAlert.classList.add('alert-danger');
		divAlert.textContent = msg;

		document.querySelector(ref).appendChild(divAlert);

		setTimeout(() => {
			divAlert.remove();
		}, 5000);

		return;
	}

	divAlert.classList.add('alert-success');
	divAlert.textContent = msg;

	setTimeout(() => {
		divAlert.remove();
	}, 5000);

	document.querySelector(ref).appendChild(divAlert);
}

// Form Session
const formSession = document.querySelector('[data-type-form="session"]');
if (formSession) {
	// Válida si las contraseñas coinciden
	formSession.addEventListener('submit', validatePasswordMatch);

	// Muestra la contraseña en el input
	const btnShowPassword = document.querySelectorAll('[data-type-btn="show-password"]');

	btnShowPassword.forEach(btn => {
		btn.addEventListener('click', () => {
			const imgEye = btn.children[0];
			const inputPassword = btn.previousElementSibling;

			if (inputPassword.type === "password") {
				inputPassword.type = "text";
				imgEye.src = 'http://localhost/hospital/public/img/eye-off.svg';
			} else {
				inputPassword.type = "password";
				imgEye.src = 'http://localhost/hospital/public/img/eye.svg';
			}
		});
	});
	
}

function validatePasswordMatch(e) {
	e.preventDefault();
	
	const inputPasswordVerify = document.querySelector('#user_passwordVerify');
	
	if (inputPasswordVerify) {
		const inputPassword = document.querySelector('#user_password');
		
		if (inputPassword.value === inputPasswordVerify.value) {
			formSession.submit();
		} else {
			showAlert('#alert', 'Los campos de contraseñas no coinciden', 'error');
		}
	} else {
		formSession.submit();
	}
}

// Redireccionar
function redirect(url, time) {
	setTimeout(() => {
		window.location.href = url;
	}, time);
}