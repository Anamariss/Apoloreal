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
  <link rel="stylesheet" href="horarios.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="assets/js/nuevo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.all.min.js" integrity="sha256-jzDvWcciH8O/yLyupa+cLM4Vef9ktr0m/d1/5wLtVpY=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css" integrity="sha256-VJuwjrIWHWsPSEvQV4DiPfnZi7axOaiWwKfXaJnR5tA=" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">


  <title>Botón con Imagen</title>
  </head>

  <body>


    <?php
    if (isset($_POST['insertar'])) {
      if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
          echo "Error: Tipo de archivo no permitido. Solo se permiten imágenes jpg, jpeg, png, webp y gif.";
          exit;
        }

        $source = $_FILES['imagen']['tmp_name'];

        $destination = __DIR__ . '/horario/' . uniqid() . '.' . $file_extension;

        if (!move_uploaded_file($source, $destination)) {
          echo "Error: No se ha podido mover la imagen.";
          exit;
        }

        require_once 'conexion.php';

        $descripcion = $_POST['comentario'];
        $imagen = $destination;

        $insert = $conn->prepare('INSERT INTO horario (comentario, imagen) VALUES (?, ?)');
        $insert->bindParam(1, $descripcion);
        $insert->bindParam(2, $imagen);

        if ($insert->execute()) {
          echo 'Se subió el archivo exitosamente';
          /*echo "<script>
          $(document).ready(function () {
          Swal.fire({
           title: 'Exitoso',
           text: 'Ha sido publicada correctamente',
           icon: 'success',
           confirmButtonText: 'Aceptar'
          }).then((result) => {
           if (result.isConfirmed) {
           $(location).attr('href', 'homeadm?page=galeria');
          }
          });
          });
          </script>";*/
        } else {
          echo 'Error al subir el archivo';
          /*echo "<script>
          $(document).ready(function () {
          Swal.fire({
           title: 'Error',
           text: 'No se pudo realizar la publicación',
           icon: 'error',
           confirmButtonText: 'Cerrar'
          }).then((result) => {
           if (result.isConfirmed) {
           $(location).attr('href', 'homeadm?page=galeria');
          }
          });
          });
          </script>";*/
        }
      }
    }
    $conn = null;
    ?>
    <?php
    require_once 'conexion.php';
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establece el modo de error PDO en excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*Función Eliminar registro*/
    if (isset($_GET['delete'])) {
      $delete = $conn->prepare('DELETE FROM horario WHERE idhorario= ?');
      $delete->bindParam(1, $_GET['delete']);
      $delete->execute();

      if ($delete) {
        echo 'Exito';
        /*echo "<script>
        Swal.fire({
          icon: 'successs',
          title: 'Exitoso...',
          text: 'Se elimino correctamente!',
        })
        </script>";*/
      } else {
        echo "Error al borrar";
      }
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
      <label for="imagen">Subir imagen</label><br>
      <input type="file" id="file" name="imagen"><br>

      <label for="comentario">Descripción de la imagen</label><br>
      <input type="text" id="desc" name="comentario"><br>


      <button type="submit" value="subir" name="insertar">Subir archivo</button>



    </form>
    <div class="container mt-1 mx-1">
      <h2 class="mb-2">Publicaciones</h2>
      <div class="row">
        <?php
        $sql = "SELECT * FROM horario";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="card col-lg-4 col-md-6 gallery-item mb-3" style="width: 450px">
              <?php
              $file_extension = pathinfo($row['imagen'], PATHINFO_EXTENSION);
              $destination = __DIR__ . 'horario/' . uniqid() . '.' . $file_extension;
              $nombreArchivoImagen = basename($row['imagen']);
              $rutaImagen = 'horario/' . $nombreArchivoImagen;


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
                  <?php echo $row['comentario']; ?>
                </h4>
                <div class="text-center">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['idhorario']; ?>"
                    title="Eliminar" class="btn btn-danger"><i class="fas fa-trash"></i>Eliminar Datos</button>
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
                  </script>
                </div>
              </div>
            </div>
            <!-- Modal eliminar datos -->
            <div class="modal fade" id="delete<?php echo $row['idhorario']; ?>">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Alerta de datos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    Realmente desea eliminar el registro?:

                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <a href="hadmin?page=horarios&delete=<?php echo $row['idhorario']; ?>" title="Aceptar"
                      class="btn btn-success">Aceptar</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>

                </div>
              </div>
            </div>
            <!-- Modal eliminar datos  -->

            <?php
          }
        }
        ?>

  </body>

</html>