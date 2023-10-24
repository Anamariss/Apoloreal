<!DOCTYPE html>
<html lang="es-CO" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apolo</title>

  <meta name="theme-color" content="#ff2e01">
  <meta name="MobileOptimized" content="width">
  <meta name="HandhledFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar" content="black-traslucent">

  <!--Tags SEO-->
  <meta name="author" content="Miproyecto">
  <meta name="description" content="Aplicativo para enseñanza de Bootstrap">
  <meta name="keyworks" content="SENA, sena, Sena, Web App, web app, WEB APP">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/nuevo.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="h-100">
  <?php

    //se abre la seccion
require_once 'conexion.php';
session_start();

if(isset($_SESSION['administrador'])){
  $search=$conn->prepare('SELECT * FROM administrador WHERE rol=?');
  $search->bindParam(1, $_SESSION['administrador']);
  $search->execute();
  $data=$search->fetch(PDO::FETCH_ASSOC);

}
if (is_array($data)) {

    ?>
    
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand fs-3 px-4" href="#">Apolo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
  </header>
  <main class="d-flex">


    <div class="clearfix">

      <span class="float-start">
        <div class="container-fluid">
          <div class="row flex-nowrap">
            <div class="d-flex flex-column justify-content-between col-auto bg-dark min-vh-100">
              <div class="mt-4">
                <a href="" class="text-white d-none d-sm-inline text-decoration-none d-flex aling-items-center ms-3"
                  role="button">
                  <a href="crear.html" class="fs-5 d-none d-sm-inline text-center text-sm-start">Bienvenido</a>
                </a>
                <hr class="text-white d-none d-sm-block" />
                <ul class="nav nav-pills flex-column mt-4 mt-sm-0" id="menu">
                  <li class="nav-item my-1">
                    <a href="hadmin" class="nav-link text-white" aria-current="page">
                      <i class="bi bi-house"></i>
                      <span class="ms-2 d-none d-sm-inline text-center text-sm-start">Inicio</span>
                    </a>
                  </li>

                  <li class="nav-item my-1">
                    <a href="hadmin?page=creareven" class="nav-link text-white" aria-current="page">
                      <i class="bi bi-calendar-event"></i>
                      <span class="ms-2 d-none d-sm-inline">Crear Evento</span>
                    </a>
                  </li>

                  <li class="nav-item my-1 disabled">
                    <a href="#sidemenu" data-bs-toggle="collapse" class="nav-link text-white">
                      <i class="bi bi-file-earmark-person"></i>
                      <span class="ms-2 d-none d-sm-inline">Registrar</span>
                    </a>

                    <ul class="nav collapse ms-1 flex-column" id="sidemenu" data-bs-parents="#menu">
                      <li class="nav-item">
                        <a href="hadmin?page=formstudent" class="nav-link text-white" aria-current="page">Alumnos</a>
                      </li>
                      <li class="nav-item">
                        <a href="hadmin?page=formadmin" class="nav-link text-white">Administrador</a>
                      </li>
                      <li class="nav-item">
                        <a href="hadmin?page=forminstrument" class="nav-link text-white">Instrumentos</a>
                      </li>
                    </ul>
                 </li>

                  <li class="nav-item my-1">
                    <a href="#sidemenu" class="nav-link text-white" data-bs-toggle="collapse">
                      <i class="bi bi-box"></i>
                      <span class="ms-2 d-none d-sm-inline text-center text-sm-start">Inventario</span>
                    </a>
                    <ul class="nav collapse ms-1 flex-column" id="sidemenu" data-bs-parents="#menu">
                      <li class="nav-item">
                        <a href="hadmin?page=inventario" class="nav-link text-white" aria-current="page">Estudiantes</a>
                      </li>
                      <li class="nav-item">
                        <a href="hadmin?page=listaa" class="nav-link text-white">Administradores</a>
                      </li>
                      <li class="nav-item">
                        <a href="hadmin?page=listai" class="nav-link text-white">Instrumentos</a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item my-1">
                    <a href="hadmin?page=horarios" class="nav-link text-white" aria-current="page">
                      <i class="bi bi-clock"></i>
                      <span class="ms-2 d-none d-sm-inline">Horarios</span>
                    </a>
                  </li>
                  <li class="nav-item my-1">
                    <a href="hadmin?page=trabajo" class="nav-link text-white" aria-current="page">
                    <i class="bi bi-briefcase-fill"></i>
                      <span class="ms-2 d-none d-sm-inline">Trabajos</span>
                    </a>
                    <a href="logout.php" class="nav-link text-white" aria-current="page">Cerrar Sesión</a>
                  </li>
                </ul>
              </div>
              <div>
              </div>
            </div>
          </div>
        </div>
      </span>
    </div>
    <main class="container p-5 mx-auto mt-5">

<?php
//Controlador del navbar
$page=isset($_GET['page']) ? strtolower($_GET['page']) : 'hadmin';
require_once './'.$page.'.php';

if ($page=='hadmin') {
    require_once 'inicio.php';
}

?>


</main>

   

    <style>
      .nav-item :hover {
        background-color: blue;
      }

      li .nav-item :hover {
        background-color: blue;
      }

    </style>
  </main>
  <!--fin de eventos-->
  <footer class="bg-dark text-center text-white fixed-bottom">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->

      <!-- Copyright -->

      © 2023 Copyright:
      <a class="text-white" href="app/iniciosesion.php">Apolo</a>

      <!-- Copyright -->
    </div>
  </footer>
  <?php 
}else{
    header('location: ./');
}
?>
</body>

</html>