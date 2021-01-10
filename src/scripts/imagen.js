$(function () {

    const boton = $("#sub-subir-foto");
    const imagen = $("#foto-userperfil");

    let widget = cloudinary.createUploadWidget({
        cloudName: "todo-friends",
        uploadPreset: "u3cmb1ao",
        cropping: true,
        showSkipCropButton: true,
        croppingAspectRatio: 1,        
        multiple: false,        
        language: "es",
        text: {
            "es": {
                "or": "O",
                "back": "Atras",
                "advanced": "Avanzado",
                "close": "Cerrar",
                "no_results": "Sin resultados",
                "search_placeholder": "Buscar archivos",
                "about_uw": "About the Upload Widget",
                "queue": {
                    "title": "Cola de subida",
                    "title_uploading_with_counter": "Subiendo{{num}} imagenes",
                    "title_uploading": "Subiendo imagenes",
                    "mini_title": "Subido",
                    "mini_title_uploading": "Subiendo",
                    "show_completed": "Completado",
                    "retry_failed": "Reintentar fallido",
                    "abort_all": "Abortado",
                    "upload_more": "Subir mas",
                    "done": "Hecho",
                    "mini_upload_count": "{{num}} subidos",
                    "mini_failed": "{{num}} fallados",
                    "statuses": {
                        "uploading": "Subiendo...",
                        "error": "Error",
                        "uploaded": "Hecho",
                        "aborted": "Abortado"
                    }
                },
                "crop": {
                    "title": "Recortar",
                    "crop_btn": "Recortar",
                    "skip_btn": "Solo subir",
                    "reset_btn": "Retroceder",
                    "close_btn": "Si",
                    "close_prompt": "Al cerrar, cancelaras las subidas. Estas seguro/a?",
                    "image_error": "Error al subir la imagen",
                    "corner_tooltip": "Mueve la esquina para cambiar tamaño",
                },
                "local": {
                    "browse": "Mi computadora",
                    "main_title": "Subir archivos",
                    "dd_title_single": "Arrastra y suelta una imagen aqui",
                    "dd_title_multi": "Arrastra y suelta una imagen aqui",
                    "drop_title_single": "Suelta una imagen para subir",
                    "drop_title_multiple": "Suelta una imagen para subir"
                },
                "menu": {
                    "files": "Mis archivos",
                    "web": "Direccion Web",
                    "camera": "Camara",
                    "gsearch": "Busqueda de imagen",
                    "gdrive": "Google Drive",
                    "dropbox": "Dropbox",
                    "facebook": "Facebook",
                    "instagram": "Instagram",
                    "shutterstock": "Shutterstock"
                },
            }
        }
    }, (err, result) => {
        if (!err && result && result.event === "success") {
            
            const imgsrc = result.info.secure_url;
            
            const antiguaURL = imagen.attr("src");

            let parametros = result.info.coordinates.custom[0];
            let px = parametros[0];
            let py = parametros[1];
            let dimension = parametros[2];

            const valores = imgsrc.split('/');
            
            let nuevaURL = valores[0] + '/' + valores[1] + '/' + valores[2] + '/' + valores[3] + '/' + valores[4] + '/' + valores[5] + '/';
            const cropping = "x_" + px.toString() + ",y_" + py.toString() + ",w_" + dimension.toString() + ",h_" + dimension.toString() + ",c_crop/";
            nuevaURL = nuevaURL + cropping;
            nuevaURL = nuevaURL + valores[7];            

            imagen.attr("src", nuevaURL);
            enviarImagen(nuevaURL, antiguaURL);

        }
    });

    boton.on('click', function () {
        widget.open();
    });

    function getAbsolutePath() {       
        var loc = window.location;
        var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
        return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
    }

    const ruta = getAbsolutePath();

    function enviarImagen(source, antigua) {
        $.ajax({
            url: 'subirImagen.php',
            type: 'POST',
            data: 'src=' + source + "&antigua=" + antigua,
            success: function (rpt) {
                console.log(rpt);
                                
            }
        });
    }
});