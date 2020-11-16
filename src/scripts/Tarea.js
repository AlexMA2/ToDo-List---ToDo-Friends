$(function () {
    const acciones =
        '<td><a href="#" class="btn btn-warning" id="btn-editar"><i class="fas fa-pen"></i></a><a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a></td > ';

    crearTarea = (titulo, desc, asignados) => {
        $(".lista-tareas").append("<tr></tr>");
        $(".lista-tareas tr:last").append("<td>" + titulo + "</td>");
        $(".lista-tareas tr:last").append("<td>" + desc + "</td>");
        $(".lista-tareas tr:last").append("<td>" + asignados + "</td>");
        $(".lista-tareas tr:last").append(acciones);
    };

    $("#formGuardarTarea").on("submit", function (event) {
        event.preventDefault();
        
        if ($("#inTitulo").val() !== "" && $("#inDesc").val() !== "") {
            console.log("ANALIZANDO...");
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
    });
});
