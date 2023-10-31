<div class="container mt-1 mx-1">
  <h2 class="mb-2">Publicaciones</h2>
  <div class="row">
    <?php
    require_once 'conexion.php';
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
        <?php
      }
    }
    ?>