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

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">


  <title>Botón con Imagen</title>
  </head>

  <body>


    <?php
    
    $file = 'prueba.pdf';
    if (is_file($file)) {
      $filename = "cv0descargado.pdf"; // el nombre con el que se descargará, puede ser diferente al original
      /*header("Content-Type: application/octet-stream");*/
      header("Content-Type: application/force-download");
      header("Content-Disposition: attachment; filename=\"$filename\"");
      readfile($file);
    } else {
      die("Error: no se encontró el archivo '$file'");
    }


    if (isset($_POST['insertar'])) {
      if (isset($_FILES['documento']) && $_FILES['documento']['error'] === UPLOAD_ERR_OK) {
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf');
        $file_extension = strtolower(pathinfo($_FILES['documento']['name'], PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
          echo "Error: Tipo de archivo no permitido. Solo se permiten imágenes jpg, jpeg, png, pdf, webp y gif.";
          exit;
        }

        $source = $_FILES['documento']['tmp_name'];

        $destination = __DIR__ . '/partitura/' . uniqid() . '.' . $file_extension;
        

        if (!move_uploaded_file($source, $destination)) {
          echo "Error: No se ha podido mover el documento.";
          exit;
        }

        require_once 'conexion.php';

        $descripcion = $_POST['comentario'];
        $documento = $destination;

        // echo "llega";die;

        $insert = $conn->prepare('INSERT INTO partitura (comentario, documento) VALUES (?, ?)');
        $insert->bindParam(1, $descripcion);
        $insert->bindParam(2, $documento);

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
      $delete = $conn->prepare('DELETE FROM partitura WHERE idpartitura= ?');
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
      <label for="documento">Subir documento</label><br>
      <input type="file" id="file" name="documento"><br>

      <label for="comentario"></label><br>
      <input type="text" id="desc" name="comentario"><br>


      <button type="submit" value="subir" name="insertar">Subir archivo</button>



    </form>
    <?php
    require_once 'conexion.php';

    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $conn->prepare('SELECT * FROM partitura');
    $result->execute();



    if ($result->rowCount() > 0) {
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //var_dump($row);die;
        ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <?php
            $file_extension = pathinfo($row['documento'], PATHINFO_EXTENSION);
            $destination = __DIR__ . 'partitura/' . uniqid() . '.' . $file_extension;
            $nombreArchivoImagen = basename($row['documento']);
            $rutaImagen = 'partitura/' . $nombreArchivoImagen;
            

            if (file_exists($rutaImagen)) {
              ?>
              <img class="card-img-top" src="<?php echo $rutaImagen; ?>" alt="Card image">

              <?php
            } else {
              ?>
              <p>Documento no encontrado</p>
              <?php
            }
            ?>

            
            <div class="card-body">
              <h4>
                <?php echo $row['comentario']; ?>
              </h4>
              <div class="text-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['idpartitura']; ?>"
                  title="Eliminar" class="btn btn-danger"><i class="fas fa-trash"></i>Eliminar Datos</button>
              </div>
            </div>
          </div>
        </div>
        </div>
        <!-- Modal eliminar datos -->
        <div class="modal fade" id="delete<?php echo $row['idpartitura']; ?>">
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
                <a href="hadmin?page=trabajo&delete=<?php echo $row['idpartitura']; ?>" title="Aceptar"
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
    <?php
include "conexion.php";

// Obtener el nombre del archivo desde la URL
$id = $_GET['id'];

//buscar el archivo en la bd
$sql = "SELECT * FROM partitura WHERE id = '$id'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1){
    $fila = mysqli_fetch_assoc($resultado);
    $archivo = $fila['documento'];
    $ruta_archivo = "partitura/" . $archivo;

    //Verificar que el archivo está en el servidor
    if (file_exists($ruta_archivo)) {
        //Enviar archivo al navegador
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' .$archivo . '"');
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "El archivo no se encontró en la base de datos";
}




?>

    

  </body>

</html>