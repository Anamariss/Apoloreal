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

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="assets/js/nuevo.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <div class="container-fluid">

      <!--imagen-->
      <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="./">
            <img src="media/logoo.png" alt="logo" width="60" height="60">
          </a>
          <!--imagen-->
          </a>
        </div>
      </nav>
      <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!--parte derecha-->
      <div class="container-fluid bg-light sticky-top">
        <div class="container">
          <nav class="navbar navbar-sxpand-lg bg-light navbar-light py-2 py-lg-0">
          </nav>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-6 mb-lg-0">
          <li class="nav-item px-2">
            <a class="nav-link active text-dark fst-italic hola" aria-current="page" href="index.html">Inicio</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link  text-dark fst-italic" href="procesos.html">Procesos</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link text-dark fst-italic" href="app/">Ingresar</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link active text-dark fst-italic" aria-current="page" href="Eventos.html">Eventos</a>
          <li class="nav-item px-2">
            <a class="nav-link  text-dark fst-italic" href="Nosotros.html">Contactanos</a>
          </li>

          <!--final derecha-->

          </li>
        </ul>
      </div>
    </div>
  </nav>


  <section class="container-fluid pt-2">
    <div class="bg-primary text-white rounded shadow mb-5 rounded border border-light py-3">
      <h1 class="fst-italic px-3 text-center animate__animated animate__heartBeat animate_delay-2">Bienvenidos</h1>
    </div>

  <section class="container-fluid">

    <div class="row">
      <div class="col-md-4">

        <div class="card" style="width: 100 border border-info py-5">
          <div class="card-body py-3 px-4">
            <h5 class="card-title py-2 fst-italic">Acerca de Eventos</h5>
            <p class="card-text fst-italic"> La Escuela de Música han participado en un sin número de eventos a nivel Municipal y Departamental donde han dejado en alto el nombre de nuestro Municipio, además de tener una gran acogida y aceptación, se ha logrado un buen reconocimiento en la región por parte de jurados y organizadores. En el año 2018, la Banda de Música fue ganadora de la convocatoria a los estímulos de circulación otorgados por el Instituto de Cultura y Patrimonio de Antioquia para participar en el IV encuentro nacional de Bandas Sinfónicas en el municipio de Aguazul Casanare.</p>

            

          </div>
        </div>
      </div>


      <div class="col-md-8 pt-1">
        <div class="ratio ratio-21x9">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/HcYuZiTXsZs?si=-PrZ7J4TeHzxE7yk"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </section>

<br>
  <!--eventos-->
  <section class="container-fluid pt-2">
    <div class="bg-primary text-white rounded shadow mb-5 rounded border border-light py-3">
      <h1 class="fst-italic px-3">Eventos realizados</h1>
    </div>

  <section class="container-fluid">

    <div class="row">
      <div class="col-md-4">
        <div class="card" style="width: 100;">
          <img src="media/Coro.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
              <span class="probootstrap-date"><i class="bi bi-calendar"></i>"#"</span>
          </div>
        </div>
      </div>
      
    </div>
  </section>
  <?php
    require_once 'app/conexion.php';
    $sql = "SELECT * FROM evento ";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="card col-lg-4 col-md-6 gallery-item mb-3" style="width: 450px">
          <?php
          $file_extension = pathinfo($row['imagen'], PATHINFO_EXTENSION);
          $destination = __DIR__ . 'eventos' . uniqid() . '.' . $file_extension;
          $nombreArchivoImagen = basename($row['imagen']);
          $rutaImagen = 'evento' . $nombreArchivoImagen;


          if (file_exists($rutaImagen)) {
            ?>
            <img class="card-img-top" src="<?php echo $rutaImagen; ?>" alt="Card image" style="width: 100%">
            <?php
          } else {
            ?>
            <p>Imagen no encontrada.</p>
            <?php
          }
          ?>
          <div class="card-body col" class="row" class="py-5 px-5 ">
            <h4>
              <?php echo $row['descripcion']; ?>
            </h4>
            <div class="text-center">
              <button type="button" data-bs-toggle="modal" class="btn btn-primary"
                onclick="showImageModal('<?php echo $rutaImagen; ?>')" aria-label="Acercar"><i
                  class="fas fa-eye"></i></button>
              <script>
                function showImageModal(imageSrc) {
                  Swal.fire({
                    title: '<?php echo $row['comentario'] ?>',
                    imageUrl: imageSrc,
                    imageWidth: 800,
                    imageHeight: 800,
                    imageAlt: '<?php echo $row['comentario'] ?>',
                    showCloseButton: true,
                    showConfirmButton: false
                  });
                }
                function showImageModal(imageSrc) {
                  Swal.fire({
                    title: '<?php echo $row['fecha'] ?>',
                    imageUrl: imageSrc,
                    imageWidth: 800,
                    imageHeight: 800,
                    imageAlt: '<?php echo $row['fecha '] ?>',
                    showCloseButton: true,
                    showConfirmButton: false
                  });
                }
              </script>
            </div>
          </div>
        </div>
        <?php
      }
    }
    ?>

  <section class="container-fluid pt-2">
    <div class="bg-primary text-white rounded shadow mb-5 rounded border border-light py-3">
      <h1 class="fst-italic px-3">Eventos a realizar</h1>
    </div>

  <section class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="card" style="width: 100;">
          <img src="media/Banda.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
              <span class="probootstrap-date"><i class="bi bi-calendar"></i>"#"</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card" style="width: 100;">
          <img src="media/guitarra.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
              <span class="probootstrap-date"><i class="bi bi-calendar"></i>"#"</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card" style="width: 100;">
          <img src="media/guitarra.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
              <span class="probootstrap-date"><i class="bi bi-calendar"></i>"#"</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="container-fluid">
    <div class="row">
      <div class="col-md-4 p-2">
        <div class="card" style="width: 100;">
          <img src="media/guitarra.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
              <span class="probootstrap-date"><i class="bi bi-calendar"></i>"#"</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 p-2">
        <div class="card" style="width: 100;">
          <img src="media/guitarra.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
              <span class="probootstrap-date"><i class="bi bi-calendar"></i>"#"</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 p-2">
        <div class="card" style="width: 100;">
          <img src="media/guitarra.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
              <span class="probootstrap-date"><i class="bi bi-calendar"></i>"#"</span>
          </div>
        </div>
      </div>
    </div>
  </section>

 

  <!--fin de eventos-->
  <footer class="bg-primary text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn text-white btn-floating m-1" aria-label="Read more about Seminole tax hike"
          style="background-color: #3b5998;" href="https://www.facebook.com/AngelJorgeMontoyaLuna?mibextid=ZbWKwL"
          role="button"><i class="bi bi-facebook"></i>
          <!-- Instagram -->
          <a class="btn text-white btn-floating m-1" aria-label="Read more about Seminole tax hike"
            style="background-color: #b31d1d;" href="https://www.youtube.com/@escuelademusicaamalfi-anti2320"
            role="button"><i class="bi bi-youtube"></i>
            <!-- whatsapp -->
          </a>
      </section>
      <!-- Section: Social media -->
      <!-- Grid container -->
      <!-- Copyright -->
      <div class="text-center p-3 bg-primary" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white" href="index.html">Apolo</a>
      </div>
      <!-- Copyright -->
    </div>
  </footer>


</body>

</html>