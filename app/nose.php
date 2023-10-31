<!doctype html>
<html lang="es">
<head>
  <title>Notas de paz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/bootstrap.bundle.js"></script>
<link rel="stylesheet" href="Tform.css">
</head>
<body>
<?php
  require_once 'conexion.php';
  
  
      if(isset($_POST['insertar'])) {
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
  
          // Validar que los campos no estén vacíos
          if (!empty($nombre) && !empty($fecha) && !empty($descripcion)) {
              // Preparar la consulta SQL
              $insert = $conn->prepare('INSERT INTO evento (nombre, fecha, descripcion) VALUES (?, ?, ?)');
              $insert->bindParam(1, $nombre);
              $insert->bindParam(2, $fecha);
              $insert->bindParam(3, $descripcion);
  
              // Ejecutar la consulta y verificar el resultado
                if ($insert->execute()) {
                    echo "Registro exitoso";
                } else {
                    echo "Error al registrar";
                }
            } else {
                echo "Por Favor llene todos los campos";
            }
      }
 
  ?>

  <header class="list">
</header>
    <section id="form" class="box w-25 m-auto">
        <h2>Crear eventos</h2>
        <form action="" method="POST" enctype="application/x-www-form-urlencoded">
           
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" required>
          
            <label for="fecha" class="form-label"></label>
           <input type="date" id="event-date" name="fecha">
           
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" required>

            <input type="file" id="event-image" accept="image/*">
            <div id="image-preview">
                <img src="#" alt="Imagen" id="uploaded-image">
           
          <button type="submit" name="insertar">Enviar</button>
          <p>Publicar</p> 
        </form>
    </section>
</body>
</html>

