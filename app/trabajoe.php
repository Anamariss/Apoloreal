<?php
      require_once 'conexion.php';

      $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $result = $conn->prepare('SELECT * FROM partitura');
      $result->execute();

      if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
                <p>Documento no encontrada.</p>
                <?php
              }
            ?>
              <div class="card-body">
                <h4>
                  <?php echo $row['comentario']; ?>
                </h4>
                <div class="text-center">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#delete" title="Eliminar"
                    class="btn btn-danger" title="Eliminar Datos"><i class="fas fa-trash"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
            <?php
        }
    }
    ?>