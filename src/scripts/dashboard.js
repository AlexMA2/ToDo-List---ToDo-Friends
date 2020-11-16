$(function () {
	
	var titulo_tarea;
	$(".lista-tareas").on("click", function (event) {
		event.preventDefault();
		let x = event.target;
		if (x.nodeName === 'I' || x.nodeName === 'A') {
			$("#overlay").addClass('active');
			$("#popup").addClass('active');
		}
		titulo_tarea = $(this).find('td:first').text();
		
	});

	$(".btn-cerrar-popup").on("click", function (event) {
		event.preventDefault();
		let x = event.target;
		if (x.nodeName === 'I' || x.nodeName === 'A') {
			$("#overlay").removeClass('active');
			$("#popup").removeClass('active');
		}
	});
	
	var acciones = '';
	acciones += '<td>';
	acciones += '<abbr title="Modificar Tarea">';
	acciones += '<a href="#" class="btn btn-warning btn-editar"><i class="fas fa-pen"></i></a>';
	acciones += '</abbr>';
	acciones += ' <abbr title="Eliminar Tarea">';
	acciones += '<a href="#" class="btn btn-danger btn-eliminar"><i class="fas fa-trash"></i></a>'
	acciones += '</abbr>';
	acciones += '</td>';

	crearTarea = (titulo, desc, fecha) => {
		$(".lista-tareas").append("<tr></tr>");
		$(".lista-tareas tr:last").append("<td>" + titulo + "</td>");
		$(".lista-tareas tr:last").append("<td>" + desc + "</td>");
		$(".lista-tareas tr:last").append("<td>" + fecha + "</td>");
		$(".lista-tareas tr:last").append(acciones);
	};

	$("#formGuardarTarea").on("submit", function (event) {
		event.preventDefault();

		if ($("#inTitulo").val() !== "" && $("#inDesc").val() !== "") {

			if ($("#inFecha").val() !== "") {
				crearTarea(
					$("#inTitulo").val(),
					$("#inDesc").val(),
					$("#inFecha").val()
				);
			} else {
				crearTarea(
					$("#inTitulo").val(),
					$("#inDesc").val(),
					"Sin fecha límite"
				);
			}
			$("#inTitulo").val("");
			$("#inDesc").val("");
			$("#inFecha").val("");
		}
	});

	editarTarea = () => {
		console.log(" TAREAS ");
		$(".lista-tareas").each(index => {
			console.log(index + ": " + $(this).text());
		});
	}
	
	editarTarea();

});
