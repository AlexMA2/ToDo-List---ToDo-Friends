<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Esta aplicacion fue creada para ayudar a una persona o a un grupo a orgnizar sus tareas.">
    <meta name="author"
        content="Gianela Mallqui, Alex Mamani, Nestor Soto, Renzo Marcos, Martin Rodriguez y Brayan Oroncuy">

    <link rel="shortcut icon" href="res/favicon1.png" type="image/x-icon">   

    <title> To-Do Friends </title>
    
    <script src="res/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>    
    <link rel="stylesheet" href="res/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">    

    <link rel="stylesheet" href="src/styles/estilos.css">
    <link rel="stylesheet" href="src/styles/cabecera.css">
    <link rel="stylesheet" href="src/styles/footer.css">

    <script src="src/scripts/MenuDesplegable.js"></script>

</head>

<body>
    <?php
    session_start();
    if(isset($_SESSION['user'])){      
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
        }
       
        session_destroy();
    }
    ?>
    <header class="cabecera">
        <div class="home">
            <a class="logo" href="index.html">
                <h1> To-Do Friends </h1>
            </a>
        </div>
        <span class="btn-burger"><i class="fa fa-bars"></i></span>
        <nav class="mynav">
            <li class="nav-item text-center"><a class="nav-link" href="src/pages/caracteristicas.html"> Caracter&iacute;sticas </a></li>
            <li class="nav-item text-center"><a class="nav-link" href="src/pages/tutorial.html"> Tutorial </a></li>
            <li class="nav-item text-center"><a class="nav-link" href="src/pages/equipos.html"> Trabajos en Equipo </a></li>
            <li class="nav-item text-center"><a class="nav-link" href="src/pages/login.html"> Iniciar Sesi&oacute;n </a></li>
            <li class="nav-item text-center"><a class="nav-link" href="src/pages/registro.html">Registrarse </a> </li>
        </nav>
        <div class="textos">
            <h1 class="titulo">TO DO LIST</h1>
            <h3 class="subtitulo">Te ayudamos a organizarte mejor</h3>
            <a href="src/pages/login.html">Comenzar</a>
        </div>
    </header>
    <main>
        <section class="acerca-de">
            <div class="contenedor">
                <h2 class="sobre-nosotros">¿Qui&eacute;nes somos?</h2>
                <h3 class="slogan">Organiza y disfruta</h3>
                <p class="parrafo">
                    Somos una plataforma que te ayudara a organizar tus labores diarias.
                    Organiza tus tareas,pendientes y proyectos etc

                </p>
                <p class="parrafo">
                   Rellenar con mas info :v
                </p>
            </div>
        </section>
        <section class="galeria">
            <div class="imagenes none">
                <img src="res/1.jpg" alt="img1">
            </div>
            <div class="imagenes">
                <img src="res/3.jpg" alt="img2">
            </div>
            <div class="imagenes">
                <img src="res/2.jpg" alt="img3">
                <div class="encima">
                    <h2>No perdamos tiempo</h2>
                    <div></div>
                </div>
            </div>
            <div class="imagenes">
                <img src="res/4.jpeg" alt="img4">

            </div>
            <div class="imagenes none">
                <img src="res/5.jpeg" alt="img5">
            </div>

        </section>
        <section class="miembros">
            <div class="contenedor">
                <h2 class="sobre-nosotros">Nuestro equipo</h2>
                <h3 class="slogan">Conoce a nuestro equipo de trabajo</h3>
                <div class="cards">
                    <div class="card">
                        <img src="res/AlexCGDesign.png" alt="">
                        <h4> Alex Sebastian </br> Mamani Acurio</h4>
                        <p> Estudiante de Ingenier&iacute;a de Software</p>
                    </div>
                    <div class="card">
                        <img src="res/AlexCGDesign.png" alt="">
                        <h4> Gianela Reyna </br> Mallqui Briceño</h4>
                        <p> Estudiante de Ingenier&iacute;a de Software</p>
                    </div>
                    <div class="card">
                        <img src="res/AlexCGDesign.png" alt="">
                        <h4> Nestor Raul </br> Soto Piñares</h4>
                        <p> Estudiante de Ingenier&iacute;a de Software</p>
                    </div>
                    <div class="card">
                        <img src="res/AlexCGDesign.png" alt="">
                        <h4> Renzo Alexis </br> Marcos De la Torre</h4>
                        <p> Estudiante de Ingenier&iacute;a de Software</p>
                    </div>
                    <div class="card">
                        <img src="res/AlexCGDesign.png" alt="">
                        <h4> Martin Andres </br> Rodriguez Cornejo</h4>
                        <p> Estudiante de Ingenier&iacute;a de Software</p>
                    </div>
                    <div class="card">
                        <img src="res/AlexCGDesign.png" alt="">
                        <h4> Brayan Richard </br> Oroncuy Fernandez</h4>
                        <p> Estudiante de Ingenier&iacute;a de Software</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="fondo">
            
            <div class="contenedor">
                <h2 class="titulo-patrocinadores">Mira que puedes hacer con nuestra p&aacute;gina </h2>
                <h3 class="subtitulo-patrocinadores">Conoce un poco m&aacute;s las funciones</h3>
                <div class="clientes">
                    <div class="cliente">
                        <h4> Calendarios </h4>
                        <img src="res/calendario.png" alt="calendario">
                    </div>
                    <div class="cliente">
                        <h4> Estados de tareas </h4>
                        <img src="res/checklist.png" alt="checklist">
                    </div>
                    <div class="cliente">
                        <h4> Chat con tu equipo </h4>
                        <img src="res/trabajo_en_equipo.png" alt="trabajo_en_equipo">
                    </div>
                    
                </div>         
                <h2 class="final-patro"> Y muchas otras cosas más. Da click <a href="src/pages/caracteristicas.html">aqu&iacute;</a> para ver todas las caracter&iacute;sticas.</h2>      
            </div>
            
        </section>
    </main>
    <footer>
        <div class="contenedor">
            <h2 class="titulo-footer">Cont&aacute;ctanos</h2>
            <h3 class="subtitulo-footer"> Nos gusta hablar con ustedes </h3>
            <div class="footer">
                <form action="">
                    <input type="text" name="" id="" placeholder="Nombre">
                    <input type="email" name="" id="" placeholder="Email">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Ingrese su mensaje..."></textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </footer>

</body>

</html>