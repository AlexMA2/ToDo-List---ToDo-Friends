$(function () {

	var cambios = new Array(3);
	$(".lista-tareas").on("click", ".item-tarea", function (event) {
		event.preventDefault();
		let x = event.target;

		if (x.nodeName === 'A' || x.nodeName === 'I') {
			if ($(x).hasClass("btn-editar")) {

				$("#overlay").addClass('active');
				$("#popup").addClass('active');

				$("#inEditTitulo").val($(this).children(".titulo-tarea").text());
				$("#inEditDesc").val($(this).children(".desc-tarea").text());
				$("#inEditFecha").val($(this).children(".fecha-tarea").text());

				cambios[0] = $(this).children(".titulo-tarea");
				cambios[1] = $(this).children(".desc-tarea");
				cambios[2] = $(this).children(".fecha-tarea");

			}
			else if ($(x).hasClass("btn-eliminar")) {
				//Codigo para eliminar la tarea
				$(this).remove();
			}
		}

	});

	$(".btn-cerrar-popup").on("click", function (event) {
		event.preventDefault();
		let x = event.target;
		if (x.nodeName === 'I' || x.nodeName === 'A') {
			$("#overlay").removeClass('active');
			$("#popup").removeClass('active');
		}
	});	

	crearTarea = (titulo, desc, fecha) => {
		let acciones = '';
		acciones += '<td>';
		acciones += '<abbr title="Modificar Tarea">';
		acciones += '<a href="#" class="btn btn-warning btn-editar"><i class="fas fa-pen btn-editar"></i></a>';
		acciones += '</abbr>';
		acciones += ' <abbr title="Eliminar Tarea">';
		acciones += '<a href="#" class="btn btn-danger btn-eliminar"><i class="fas fa-trash btn-eliminar"></i></a>'
		acciones += '</abbr>';
		acciones += '</td>';

		$(".lista-tareas").append("<tr class='item-tarea'></tr>");
		$(".lista-tareas tr:last").append("<td class='titulo-tarea'>" + titulo + "</td>");
		$(".lista-tareas tr:last").append("<td class='desc-tarea'>" + desc + "</td>");
		$(".lista-tareas tr:last").append("<td class='fecha-tarea'>" + fecha + "</td>");
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

		}

		$("#inTitulo").val("");
		$("#inDesc").val("");
		$("#inFecha").val("");

	});

	$("#formEditarTarea").on("submit", function (event) {
		event.preventDefault();
		if ($("#inEditTitulo").val() !== "" && $("#inEditDesc").val() !== "") {

			cambios[0].text($("#inEditTitulo").val());
			cambios[1].text($("#inEditDesc").val());

			if ($("#inEditFecha").val() !== "") {
				cambios[2].text($("#inEditFecha").val());
			} else {
				cambios[2].text("Sin fecha límite");
			}

			$("#inEditTitulo").val("");
			$("#inEditDesc").val("");
			$("#inEditFecha").val("");
		}

		$("#overlay").removeClass('active');
		$("#popup").removeClass('active');

	});
	
});
