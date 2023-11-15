const urlServer = 'http://hospitaldev.test';

// Peticion AJAX para las tablas
let actualPage = 1;
const inputFilter = document.querySelector('#filter');
if (inputFilter) {
	getData(actualPage);
	inputFilter.addEventListener('keyup', () => {
		getData(1);
	});

	const selectLimit = document.querySelector('#select_limit');
	selectLimit.addEventListener('change', () => {
		getData(actualPage);
	});
}

function getData(page) {
	const controller = document.querySelector('#controller').value;
	const inputFilter = document.querySelector('#filter').value;
	const selectLimit = document.querySelector('#select_limit').value;

	const content = document.querySelector('#content');
	const url = `${urlServer}/app/Controllers/${controller}/load.php`;

	if (page !== null) {
		actualPage = page;
	}

	const formData = new FormData();
	formData.append('filter', inputFilter);
	formData.append('registers', selectLimit);
	formData.append('page', actualPage);

	const spinner = document.querySelector('#spinner');
	spinner.classList.remove('d-none');

	fetch(url, {
		method: 'POST',
		body: formData
	})
		.then(response => response.json())
		.then(data => {
			spinner.classList.add('d-none');
			content.innerHTML = data.data;

			const lblTotalRegisters = document.querySelector('#total_registers');
			lblTotalRegisters.textContent = `Mostrando ${data.total_filter} de ${data.total_registers} registros`;

			const navPagination = document.querySelector('#nav-pagination');
			navPagination.innerHTML = data.pagination;


			// Válida si se desea eliminar un registro
			const formsDelete = document.querySelectorAll('[data-type-form="delete"]');
			formsDelete.forEach(form => {
				form.addEventListener('submit', e => {
					e.preventDefault();
					const btnFormDelete = form.firstElementChild.nextElementSibling;
					btnFormDelete.addEventListener('click', form.submit());
				});
			});
		})
		.catch(err => console.log(err));
}

// Muestra una alerta al usuario
function showAlert(ref, msg, type) {
	const divAlert = document.createElement('div');
	divAlert.classList.add('alert', 'my-3');

	if (type === 'error') {
		divAlert.classList.add('alert-danger');
		divAlert.textContent = msg;

		document.querySelector(ref).appendChild(divAlert);

		return;
	}

	divAlert.classList.add('alert-success');
	divAlert.textContent = msg;

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
				imgEye.src = `${urlServer}/public/img/eye-off.svg`;
			} else {
				inputPassword.type = "password";
				imgEye.src = `${urlServer}/public/img/eye.svg`;
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