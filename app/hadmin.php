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

  if (isset($_SESSION['administrador'])) {
    $search = $conn->prepare('SELECT * FROM administrador WHERE rol=?');
    $search->bindParam(1, $_SESSION['administrador']);
    $search->execute();
    $data = $search->fetch(PDO::FETCH_ASSOC);
  }
  if (is_array($data)) {

  ?>

    <header class="header">
      <div class="container">
        <div class="btn-menu">
          <label for="btn-menu">☰</label>
        </div>
      </div>
    </header>
    <!----------------->
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
      <div class="cont-menu">
      <label for="btn-menu">✖️</label>
        <nav>
          <a href="hadmin" class="nav-link text-white" aria-current="page">
            <i class="bi bi-house"></i>
            <span class="ms-2 d-none d-sm-inline text-center text-sm-start">Inicio</span>
          </a>

          <a href="hadmin?page=creareven" class="nav-link text-white" aria-current="page">
            <i class="bi bi-calendar-event"></i>
            <span class="ms-2 d-none d-sm-inline">Crear Evento</span>

          </a>

          <a href="#" data-bs-toggle="collapse" data-bs-target="#sidemenu" class="nav-link text-white">
            <i class="bi bi-file-earmark-person"></i>
            <span class="ms-2 d-sm-inline">Registrar</span>
          </a>
          <ul class="collapse ms-1" id="sidemenu">
            <a href="hadmin?page=formstudent" class="nav-link text-white">Alumnos</a>
            <a href="hadmin?page=formadmin" class="nav-link text-white">Administrador</a>
            <a href="hadmin?page=forminstrument" class="nav-link text-white">Instrumentos</a>
          </ul>

          <a href="hadmin?page=horarios" class="nav-link text-white" aria-current="page">
              <i class="bi bi-clock"></i>
              <span class="ms-2 d-none d-sm-inline">Inventario</span>
            </a>
          
            <a href="hadmin?page=horarios" class="nav-link text-white" aria-current="page">
              <i class="bi bi-clock"></i>
              <span class="ms-2 d-none d-sm-inline">Horarios</span>
            </a>

            <a href="hadmin?page=trabajo" class="nav-link text-white" aria-current="page">
              <i class="bi bi-briefcase-fill"></i>
              <span class="ms-2 d-none d-sm-inline">Trabajos</span>
            </a>

            <a href="index.php"  class="nav-link text-white " aria-current="page">
              <i class="bi bi-arrow-left-circle"></i>
              <span class="ms-2 d-none d-sm-inline">Cerrar sesion</span>
            </a>
        </nav>  
      </div>
    </div>


    <?php
    //Controlador del navbar
    $page = isset($_GET['page']) ? strtolower($_GET['page']) : 'hadmin';
    require_once './' . $page . '.php';

    if ($page == 'hadmin') {
      require_once 'inicio.php';
    }

    ?>



    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat Alternates', sans-serif;
      }

      body {
        background: url(https://i.pinimg.com/736x/a0/bf/1d/a0bf1dc3d490cdfb46839739ca8dcdab--amalfi-colombia.jpg);
        background-size: 100vw 100vh;
        background-repeat: no-repeat;
      }

      .capa {
        position: fixed;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        z-index: -1;
        top: 0;
        left: 0;
      }

      /*Estilos para el encabezado*/
      .header {
        width: 100%;
        height: 100px;
        position: fixed;
        top: 0;
        left: 0;
      }

    
      .container .btn-menu,
      .logo {
        float: left;
        line-height: 100px;
      }

      .container .btn-menu label {
        color: #fff;
        font-size: 25px;
        cursor: pointer;
      }
   
      /*Fin de Estilos para el encabezado*/

      /*Menù lateral*/
      #btn-menu {
        display: none;
      }

      .container-menu {
        position: absolute;
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
        transition: all 500ms ease;
        opacity: 0;
        visibility: hidden;
      }

      #btn-menu:checked~.container-menu {
        opacity: 1;
        visibility: visible;
      }

      .cont-menu {
        width: 100%;
        max-width: 250px;
        background: #1c1c1c;
        height: 100vh;
        position: relative;
        transition: all 500ms ease;
        transform: translateX(-100%);
      }

      #btn-menu:checked~.container-menu .cont-menu {
        transform: translateX(0%);
      }

      .cont-menu nav {
        transform: translateY(7%);
      }

      .cont-menu nav a {
        display: block;
        text-decoration: none;
        padding: 20px;
        color: #c7c7c7;
        border-left: 5px solid transparent;
        transition: all 400ms ease;
      }

      .cont-menu nav a:hover {
        border-left: 5px solid #c7c7c7;
        background: #1f1f1f;
      }

      .cont-menu label {
        position: absolute;
        right: 5px;
        top: 10px;
        color: #fff;
        cursor: pointer;
        font-size: 18px;
      }

      /*Fin de Menù lateral*/
    </style>
    </main>

  <?php
  } else {
    header('location: ./');
  }
  ?>
</body>

</html>