<?php
if (isset($_POST['insertar'])) {
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $allowed_extensions = array('pdf', 'doc', 'docx');
        $file_extension = strtolower(pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Error: Tipo de archivo no permitido. Solo se permiten imágenes doc, pdf y docx.";
            exit;
        }

        $source = $_FILES['archivo']['tmp_name'];

        $destination = __DIR__ . '/partitura/' . uniqid() . '.' . $file_extension;

        if (!move_uploaded_file($source, $destination)) {
            echo "Error: No se ha podido mover el archivo.";
            exit;
        }

        require_once 'conexion.php';

        $nombre = $_POST['nombre'];
        $comentario = $_POST['comentario'];
        $archivo = $destination;

        $insert = $conn->prepare('INSERT INTO partitura (nombre, comentario, archivo) VALUES (?, ?, ?)');
        $insert->bindParam(1, $nombre);
        $insert->bindParam(2, $comentario);
        $insert->bindParam(3, $archivo);

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
?>
<?php 
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
    <label for="nombre" class="form-label">Nombre de archivo</label>
    <input type="text" name="nombre" required>
    <label for="comentario" class="form-label">Comentario</label>
    <input type="text" name="comentario" required>
    <label for="archivo" class="form-label">Documento</label>
    <input type="file" name="archivo" required>
    <br>
    <button name="insertar" type="submit" style="margin: 10px;">Enviar</button>
    <p>¡WELCOME!</p>
</form>
<div class="container mt-1 mx-1">
    <h2 class="mb-2">Publicaciones</h2>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Comentario</th>
                <th>Archivo</th>
                <th>Descargar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'conexion.php';
            $result = $conn->prepare('SELECT * FROM partitura');
            $result->execute();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td>
                        <?php echo $row['nombre']; ?>
                    </td>
                    <td>
                        <?php echo $row['comentario']; ?>
                    </td>
                    <td>
                        <?php echo $row['archivo']; ?>
                    </td>
                    <?php
                    require_once 'conexion.php';
                    if (isset($_GET['descargar'])) {
                        $partituraId = $_GET['descargar'];

                        $sql = $conn->prepare("SELECT * FROM partitura WHERE idpartitura = ?");
                        $sql->bindParam(1, $partituraId);

                        if ($sql->execute()) {
                            $fila = $sql->fetch();
                            $archivo = $fila['archivo'];
                            $ruta_archivo = "partitura/" . $archivo;

                            if (file_exists($ruta_archivo)) {
                                header('Content-Type: application/file');
                                header('Content-Disposition: attachment; filename="' . $archivo . '"');
                                readfile($ruta_archivo);
                                exit; 
                            } else {
                                echo "El archivo no existe en el servidor.";
                            }
                        } else {
                            echo "Error al obtener la partitura.";
                        }
                    }
                    ?>
                    <td>
                        <a href="hadmin?page=prueba&partitura=<?php echo $row['idpartitura']; ?>&descargar=<?php echo $row['idpartitura']; ?>"
                            class="btn btn-primary" name="descargar">
                            <i class="fas fa-download"></i> Descargar
                        </a>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#delete<?php echo $row['idpartitura']; ?>" title="Eliminar"
                            class="btn btn-danger"><i class="fas fa-trash"></i>Eliminar Datos</button>
                    </td>
                </tr>
            </tbody>
        </table>
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
                        <a href="hadmin?page=prueba&delete=<?php echo $row['idpartitura']; ?>" title="Aceptar"
                            class="btn btn-success">Aceptar</a>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal eliminar datos  -->

        <?php
            }
            ?>