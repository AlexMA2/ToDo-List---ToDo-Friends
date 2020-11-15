var btnAbrirPopup = document.getElementById('btn-editar'),
	overlay = document.getElementById('overlay'),
	popup = document.getElementById('popup'),
	btnCerrarPopup = document.getElementById('btn-cerrar-popup');


btnAbrirPopup.addEventListener('click', function () {
	overlay.classList.add('active');
	console.log("activo modal");
	popup.classList.add('active');
});

btnCerrarPopup.addEventListener('click', function () {
	overlay.classList.remove('active');
	popup.classList.remove('active');
});